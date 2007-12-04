/*
   +----------------------------------------------------------------------+
   | PHP Version 4                                                        |
   +----------------------------------------------------------------------+
   | Copyright (c) 1997-2002 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 2.02 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available at through the world-wide-web at                           |
   | http://www.php.net/license/2_02.txt.                                 |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Author: Sara Golemon <pollita@php.net>                               |
   +----------------------------------------------------------------------+
*/

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"

#if WITH_OGGVORBIS

#include "oggvorbis.h"
#include "php_globals.h"
#include "ext/standard/info.h"
#include "ext/standard/php_rand.h"
#include <vorbis/codec.h>
#include <vorbis/vorbisenc.h>
#include <ogg/ogg.h>

zend_module_entry oggvorbis_module_entry = {
	STANDARD_MODULE_HEADER,
	"oggvorbis",
	NULL, /* functions */
	PHP_MINIT(oggvorbis),
	PHP_MSHUTDOWN(oggvorbis),
	NULL, /* RINIT */
	NULL, /* RSHUTDOWN */
	PHP_MINFO(oggvorbis),
	NO_VERSION_YET,
	STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_OGGVORBIS
ZEND_GET_MODULE(oggvorbis)
#endif

static int php_oggvorbis_init_readstream(php_stream *stream TSRMLS_DC);
static int php_oggvorbis_init_writestream(php_stream *stream TSRMLS_DC);
static int php_oggvorbis_end_readstream(php_stream *stream TSRMLS_DC);

#define OGGVORBIS_READ_HEADER	1
#define	OGGVORBIS_READ_AUDIO	2
#define OGGVORBIS_WRITE			3

#define OGGVORBIS_PCM_U8		0x10
#define OGGVORBIS_PCM_S8		0x11
#define OGGVORBIS_PCM_U16_BE	0x20
#define OGGVORBIS_PCM_U16_LE	0x21
#define OGGVORBIS_PCM_S16_BE	0x22
#define OGGVORBIS_PCM_S16_LE	0x23

#define OGGVORBIS_PCM_8BIT		0x10
#define OGGVORBIS_PCM_16BIT		0x20

#define OGGVORBIS_PCM_SIGNED	0x02 /* 0010 */
#define OGGVORBIS_PCM_LE		0x01 /* 0001 */

#define OGGVORBIS_PCM_MASK		0xF0

#define OGGVORBIS_DEFAULT_RATE		44100
#define OGGVORBIS_DEFAULT_BITRATE	128000
#define OGGVORBIS_DEFAULT_QUALITY	0.4
#define OGGVORBIS_DEFAULT_CHANNELS	2
#define OGGVORBIS_DEFAULT_PCM		OGGVORBIS_PCM_S16_LE

#define OGGVORBIS_VBR_MINIMUM		-1.0
#define OGGVORBIS_VBR_MAXIMUM		 1.0

#define OGGVORBIS_CHECK_PCM_MODE(m)	(((m) >= 0x20 && (m) <= 0x23) || (m) == 0x10 || (m) == 0x11)

#define OGGVORBIS_RATE_MINIMUM		8192
#define OGGVORBIS_RATE_MAXIMUM		48200

#define OGGVORBIS_BITRATE_MINIMUM	16000
#define OGGVORBIS_BITRATE_MAXIMUM	131072

#define OGGVORBIS_CHANNELS_MINIMUM	1
#define OGGVORBIS_CHANNELS_MAXIMUM	16

#define OGGVORBIS_COMMENT_ENCODER	"PHP/OggVorbis, http://pear.php.net/oggvorbis"

/* stream data */

typedef struct _php_oggvorbis_data {
	php_stream *innerstream;
	int mode;
	int pcm_mode;

	ogg_sync_state sync_state;
	ogg_stream_state stream_state;
	ogg_page page;
	ogg_packet packet;

	vorbis_info vinfo;
	vorbis_comment vcomment;
	vorbis_dsp_state vdsp;
	vorbis_block vblock;
} php_oggvorbis_data;

/* Ogg Vorbis Stream */

static int php_oggvorbis_init_writestream(php_stream *stream TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data *)stream->abstract;
	php_stream_context *context = stream->context;
	zval **tmpzval;
	int rate = OGGVORBIS_DEFAULT_RATE;
	int bitrate = OGGVORBIS_DEFAULT_BITRATE;
	int channels = OGGVORBIS_DEFAULT_CHANNELS;
	long serialno = php_rand(TSRMLS_C);
	double vbr = OGGVORBIS_DEFAULT_QUALITY;
	ogg_packet h1, h2, h3;

	if (context &&
		php_stream_context_get_option(context, "ogg", "rate", &tmpzval) == SUCCESS &&
		Z_TYPE_PP(tmpzval) == IS_LONG &&
		Z_LVAL_PP(tmpzval) >= OGGVORBIS_RATE_MINIMUM &&
		Z_LVAL_PP(tmpzval) <= OGGVORBIS_RATE_MAXIMUM) {
		rate = Z_LVAL_PP(tmpzval);
	}

	if (context &&
		php_stream_context_get_option(context, "ogg", "bitrate", &tmpzval) == SUCCESS) {
		if (Z_TYPE_PP(tmpzval) == IS_LONG &&
			Z_LVAL_PP(tmpzval) >= OGGVORBIS_BITRATE_MINIMUM &&
			Z_LVAL_PP(tmpzval) <= OGGVORBIS_BITRATE_MAXIMUM) {
			bitrate = Z_LVAL_PP(tmpzval);
		} else if (Z_TYPE_PP(tmpzval) == IS_DOUBLE &&
				   Z_DVAL_PP(tmpzval) >= OGGVORBIS_VBR_MINIMUM &&
				   Z_DVAL_PP(tmpzval) <= OGGVORBIS_VBR_MAXIMUM) {
			bitrate = 0;
			vbr = Z_DVAL_PP(tmpzval);
		}
	}

	if (context &&
		php_stream_context_get_option(context, "ogg", "channels", &tmpzval) == SUCCESS &&
		Z_TYPE_PP(tmpzval) == IS_LONG &&
		Z_LVAL_PP(tmpzval) >= OGGVORBIS_CHANNELS_MINIMUM &&
		Z_LVAL_PP(tmpzval) <= OGGVORBIS_CHANNELS_MAXIMUM) {
		channels = Z_LVAL_PP(tmpzval);
	}

	vorbis_info_init(&(data->vinfo));
	if (bitrate) {
		if (vorbis_encode_init(&(data->vinfo), channels, rate, -1, bitrate, -1)) {
			vorbis_info_clear(&(data->vinfo));
			return FAILURE;
		}
	} else {
		if (vorbis_encode_init_vbr(&(data->vinfo), channels, rate, vbr)) {
			vorbis_info_clear(&(data->vinfo));
			return FAILURE;
		}
	}

	/* Setup comments */
	vorbis_comment_init(&(data->vcomment));
	if (context &&
		php_stream_context_get_option(context, "ogg", "comments", &tmpzval) == SUCCESS &&
		(Z_TYPE_PP(tmpzval) == IS_ARRAY || Z_TYPE_PP(tmpzval) == IS_OBJECT) &&
		zend_hash_num_elements(HASH_OF(*tmpzval)) > 0) {
		ulong key_type, idx;
		char *key, *tmpstr;
		zval **cmtval;

		for (zend_hash_internal_pointer_reset(HASH_OF(*tmpzval));
			(key_type = zend_hash_get_current_key(HASH_OF(*tmpzval), &key, &idx, 0)) != HASH_KEY_NON_EXISTANT;
			zend_hash_move_forward(HASH_OF(*tmpzval))) {
			if (key_type == HASH_KEY_IS_STRING) {
				/* Skip numeric keys */
				if (zend_hash_get_current_data(HASH_OF(*tmpzval), (void **)&cmtval) == SUCCESS) {
					switch (Z_TYPE_PP(cmtval)) {
						case IS_STRING:
							vorbis_comment_add_tag(&(data->vcomment), key, Z_STRVAL_PP(cmtval));
							break;
						case IS_LONG:
							spprintf(&tmpstr, 12, "%ld", Z_LVAL_PP(cmtval));
							vorbis_comment_add_tag(&(data->vcomment), key, tmpstr);
							efree(tmpstr);
							break;
						case IS_DOUBLE:
							spprintf(&tmpstr, 32, "%f", Z_DVAL_PP(cmtval));
							vorbis_comment_add_tag(&(data->vcomment), key, tmpstr);
							efree(tmpstr);
							break;
						default:
							/* Do nothing with other types */
							break;
					}
				}
			}
		}
	}
	vorbis_comment_add_tag(&(data->vcomment), "ENCODER", OGGVORBIS_COMMENT_ENCODER);
		
	vorbis_analysis_init(&(data->vdsp), &(data->vinfo));
	vorbis_block_init(&(data->vdsp), &(data->vblock));

	/* Setup serial number for this stream */
	if (context &&
		php_stream_context_get_option(context, "ogg", "serialno", &tmpzval) == SUCCESS &&
		Z_TYPE_PP(tmpzval) == IS_LONG) {
		serialno = Z_LVAL_PP(tmpzval);
	}

	ogg_stream_init(&(data->stream_state), serialno);

	/* Generate and add headers to the new stream */
	vorbis_analysis_headerout(&(data->vdsp), &(data->vcomment), &h1, &h2, &h3);
	ogg_stream_packetin(&(data->stream_state), &h1);
	ogg_stream_packetin(&(data->stream_state), &h2);
	ogg_stream_packetin(&(data->stream_state), &h3);

	/* drop the data into the output stream */
	while (ogg_stream_flush(&(data->stream_state), &(data->page))) {
		php_stream_write(data->innerstream, data->page.header,	data->page.header_len);
		php_stream_write(data->innerstream, data->page.body, data->page.body_len);
	}

	/* ready to encode data! */

	return SUCCESS;
}

static size_t php_oggvorbis_write(php_stream *stream, const char *buf, size_t count TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data *)stream->abstract;
	int sample_size, num_samples, i, j, bytes_per_sample, pcm_signed, val;
	float **samples;
	char *b = (char *)buf;

	if (!data) {
		return -1;
	}

	if (count == 0) {
		return 0;
	}

	bytes_per_sample = (data->pcm_mode & OGGVORBIS_PCM_MASK) >> 4;
	pcm_signed = (data->pcm_mode & OGGVORBIS_PCM_SIGNED);

	sample_size = bytes_per_sample * data->vinfo.channels;
	num_samples = (int) (count / sample_size);

	if (num_samples == 0) {
		/* Not enough to encode */
		return 0;
	}

	samples = vorbis_analysis_buffer(&(data->vdsp), num_samples);
	for (j = 0; j < num_samples; j++) {
		for(i = 0; i < data->vinfo.channels; i++) {
			switch (data->pcm_mode & OGGVORBIS_PCM_MASK) {
				case OGGVORBIS_PCM_8BIT:
					val = *b & 0xFF;
					if (pcm_signed) {
						if (val > 127) {
							val -= 256;
						}
						samples[i][j] = (float)( val / 127.0);
					} else {
						samples[i][j] = (float)( val / 127.0) - 1.0;
					}
					break;
				case OGGVORBIS_PCM_16BIT:
					if (data->pcm_mode & OGGVORBIS_PCM_LE) {
						val = (b[0] & 0xFF) | ((b[1] & 0xFF) << 8);
					} else {
						val = (b[1] & 0xFF) | ((b[0] & 0xFF) << 8);
					}
					if (pcm_signed) {
						if (val > 32767) {
							val -= 65536;
						}
						samples[i][j] = (float)(val / 32767.0);
					} else {
						samples[i][j] = (float)(val / 32767.0) - 1.0;
					}
					break;
				default:
					/* Should never happen 
					   Indicates invalid encoding mode */
					return -1;
			}
			b += bytes_per_sample;
		}
	}
	vorbis_analysis_wrote(&(data->vdsp), num_samples);

	/* Write as much data as is available */
	while (vorbis_analysis_blockout(&(data->vdsp), &(data->vblock))==1) {
		vorbis_analysis(&(data->vblock), NULL);
		vorbis_bitrate_addblock(&(data->vblock));

		while (vorbis_bitrate_flushpacket(&(data->vdsp), &(data->packet))) {
			ogg_stream_packetin(&(data->stream_state), &(data->packet));

			while (ogg_stream_pageout(&(data->stream_state), &(data->page))) {
				php_stream_write(data->innerstream, data->page.header, data->page.header_len);
				php_stream_write(data->innerstream, data->page.body, data->page.body_len);
			}
		}
	}

	return num_samples * sample_size; /* Not necessarily == count */
}

static int php_oggvorbis_getpage(php_stream *stream TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data *)stream->abstract;
	int result, bytes;
	char *buffer;

	if (!data) {
		return FAILURE;
	}

	while ((result = ogg_sync_pageout(&(data->sync_state), &(data->page))) == 0) {
		buffer = ogg_sync_buffer(&(data->sync_state), OGGVORBIS_CHUNK_SIZE);
		bytes = php_stream_read(data->innerstream, buffer, OGGVORBIS_CHUNK_SIZE);
		ogg_sync_wrote(&(data->sync_state), bytes);
		if (bytes <= 0) {
			return FAILURE;
		}
	}

	if (result > 0) {
		return SUCCESS;
	}

	return FAILURE;
}

static int php_oggvorbis_getpacket(php_stream *stream TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data *)stream->abstract;
	int result, eos = 0;

	if (!data) {
		return FAILURE;
	}

	while ((result = ogg_stream_packetout(&(data->stream_state), &(data->packet))) == 0) {
		/* Before grabbing another page, let's find out if this page ends a stream
		   We'll always have *some* page in the buffer because of initstream */
		if (ogg_page_eos(&(data->page)) && eos++ > 0) {
			/* End of header *may* yield false positive */
			/* This stream has ended. */
			php_oggvorbis_end_readstream(stream TSRMLS_CC);
			return FAILURE;
		}
		if (php_oggvorbis_getpage(stream TSRMLS_CC) == FAILURE) {
			return FAILURE;
		}
		ogg_stream_pagein(&(data->stream_state), &(data->page));		
	}

	if (result > 0) {
		return SUCCESS;
	}

	return FAILURE;
}

static int php_oggvorbis_pcmout(php_stream *stream, int *psamples, float ***pcm TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data *)stream->abstract;
	int samples;

	while ((samples = vorbis_synthesis_pcmout(&(data->vdsp), pcm)) == 0) {
		if (php_oggvorbis_getpacket(stream TSRMLS_CC) == FAILURE) {
			return FAILURE;
		}

		if (vorbis_synthesis(&(data->vblock), &(data->packet)) != 0) {
			return FAILURE;
		}

		vorbis_synthesis_blockin(&(data->vdsp), &(data->vblock));
	}

	if (samples > 0) {
		if (psamples) {
			*psamples = samples;
		}
		return SUCCESS;
	}

	return FAILURE;
}

static int php_oggvorbis_init_readstream(php_stream *stream TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data *)stream->abstract;
	int bytes, n = 0;
	char **comments, *buffer;
	zval *songdata, *commentlist = NULL;

	if (!data) {
		return FAILURE;
	}

	if (php_oggvorbis_getpage(stream TSRMLS_CC) != SUCCESS) {
		return FAILURE;
	}

	ogg_stream_init(&(data->stream_state), ogg_page_serialno(&(data->page)));
	vorbis_info_init(&(data->vinfo));
	vorbis_comment_init(&(data->vcomment));

	if (ogg_stream_pagein(&(data->stream_state), &(data->page)) < 0) {
		return FAILURE;
	}

	if (php_oggvorbis_getpacket(stream TSRMLS_CC) != SUCCESS) {
		return FAILURE;
	}

	if (vorbis_synthesis_headerin(&(data->vinfo), &(data->vcomment), &(data->packet)) < 0) {
		return FAILURE;
	}

	while (n < 2) {
		while (n < 2) {
			int result = ogg_sync_pageout(&(data->sync_state), &(data->page));
			if (result == 0) {
				break;
			}
			if (result == 1) {
				ogg_stream_pagein(&(data->stream_state), &(data->page));

				while (n < 2) {
					result = ogg_stream_packetout(&(data->stream_state), &(data->packet));
					if (result == 0) {
						break;
					}
					if (result < 0) {
						return FAILURE;
					}
					vorbis_synthesis_headerin(&(data->vinfo), &(data->vcomment), &(data->packet));
					n++;
				}
			}
		}
		buffer = ogg_sync_buffer(&(data->sync_state), OGGVORBIS_CHUNK_SIZE);
		bytes = php_stream_read(data->innerstream, buffer, OGGVORBIS_CHUNK_SIZE);
		if ((bytes == 0) && (n < 2)) {
			/* Out of data on innerstream */
			return FAILURE;
		}
		ogg_sync_wrote(&(data->sync_state), bytes);
	}

	ALLOC_INIT_ZVAL(songdata);
	array_init(songdata);
	add_assoc_long(songdata, "channels", data->vinfo.channels);
	add_assoc_long(songdata, "rate", data->vinfo.rate);
	add_assoc_long(songdata, "bitrate_lower", data->vinfo.bitrate_lower);
	add_assoc_long(songdata, "bitrate_upper", data->vinfo.bitrate_upper);
	add_assoc_long(songdata, "bitrate_nominal", data->vinfo.bitrate_nominal);
	add_assoc_long(songdata, "bitrate_window", data->vinfo.bitrate_window);

	add_assoc_string(songdata, "vendor", data->vcomment.vendor, 1);
	comments = data->vcomment.user_comments;
	if (*comments) {
		ALLOC_INIT_ZVAL(commentlist);
		array_init(commentlist);
		while (*comments) {
			add_next_index_string(commentlist, *(comments++), 1);
		}
		add_assoc_zval(songdata, "comments", commentlist);
	}
	add_next_index_zval(stream->wrapperdata, songdata);

	vorbis_synthesis_init(&(data->vdsp), &(data->vinfo));
	vorbis_block_init(&(data->vdsp), &(data->vblock));	

	data->mode = OGGVORBIS_READ_AUDIO;

	return SUCCESS;
}

static int php_oggvorbis_end_readstream(php_stream *stream TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data *)stream->abstract;

	ogg_stream_clear(&(data->stream_state));

	vorbis_block_clear(&(data->vblock));
	vorbis_dsp_clear(&(data->vdsp));
	vorbis_comment_clear(&(data->vcomment));
	vorbis_info_clear(&(data->vinfo));

	data->mode = OGGVORBIS_READ_HEADER;

	return SUCCESS;
}

static size_t php_oggvorbis_read(php_stream *stream, char *buf, size_t count TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data *)stream->abstract;
	int i, j, samples, maxsamples, bytes_per_sample, pcm_signed;
	float **pcm;

	if (!data) {
		return -1;
	}

	if ((data->mode != OGGVORBIS_READ_HEADER) && (data->mode != OGGVORBIS_READ_AUDIO)) {
		/* Not in read mode */
		return -1;
	}

	if (data->mode != OGGVORBIS_READ_AUDIO) {
		if (php_oggvorbis_init_readstream(stream TSRMLS_CC) != SUCCESS) {
			/* No more chained streams */
			stream->eof = 1;
			return -1;
		}
	}

	bytes_per_sample = (data->pcm_mode & OGGVORBIS_PCM_MASK) >> 4;
	pcm_signed = (data->pcm_mode & OGGVORBIS_PCM_SIGNED);

	maxsamples = (count / (bytes_per_sample * data->vinfo.channels)) - 1;

	if (php_oggvorbis_pcmout(stream, &samples, &pcm TSRMLS_CC) == FAILURE) {
		return -1;
	}

	if (samples > maxsamples) {
		/* Don't process more than we have buffer for. */
		samples = maxsamples;
	}

	/* convert floating LLLLLRRRRR into integer LRLRLRLRLR */
	for (i = 0; i < data->vinfo.channels; i++) {
		char *ptr = buf + (i * bytes_per_sample);
		float *mono = pcm[i];

		for (j = 0; j < samples; j++) {
			unsigned long val;
			float flt = mono[j];

			if (pcm_signed) {
				if (flt > 1.0) {
					flt = 1.0;
				}
				if (flt < -1.0) {
					flt = -1.0;
				}
			} else {
				flt += 1.0;
				if (flt > 2.0) {
					flt = 2.0;
				}
				if (flt < 0.0) {
					flt = 0.0;
				}
			}

			flt += 0.000001;

			switch (data->pcm_mode & OGGVORBIS_PCM_MASK) {
				case OGGVORBIS_PCM_8BIT:
					*ptr = (char) (flt * 127.0);
					break;
				case OGGVORBIS_PCM_16BIT:
					val = flt * 32767.0;
					if (data->pcm_mode & OGGVORBIS_PCM_LE) {
						*ptr = (char)(val & 0xFF);
						*(ptr+1) = (char)(val >> 8);
					} else {
						*(ptr+1) = (char)(val & 0xFF);
						*ptr = (char)(val >> 8);
					}
					break;
				default:
					/* Invalid decode mode */
					return -1;
					break;
			}					
			ptr += data->vinfo.channels * bytes_per_sample;
		}
	}

	vorbis_synthesis_read(&(data->vdsp), samples);
	return (bytes_per_sample * data->vinfo.channels * samples);
}

static int php_oggvorbis_close(php_stream *stream, int close_handle TSRMLS_DC)
{
	php_oggvorbis_data *data = (php_oggvorbis_data*)stream->abstract;

	if (data) {
		if (data->mode == OGGVORBIS_WRITE) {
			/* Flush the analysis buffer */
			vorbis_analysis_wrote(&(data->vdsp), 0);

			/* Write as much data as is available */
			while (vorbis_analysis_blockout(&(data->vdsp), &(data->vblock))==1) {
				vorbis_analysis(&(data->vblock), NULL);
				vorbis_bitrate_addblock(&(data->vblock));

				while (vorbis_bitrate_flushpacket(&(data->vdsp), &(data->packet))) {
					ogg_stream_packetin(&(data->stream_state), &(data->packet));

					while (ogg_stream_pageout(&(data->stream_state), &(data->page))) {
						php_stream_write(data->innerstream, data->page.header, data->page.header_len);
						php_stream_write(data->innerstream, data->page.body, data->page.body_len);
					}
				}
			}
		} else {
			ogg_sync_clear(&(data->sync_state));
		} 
		if (data->innerstream) {
			php_stream_close(data->innerstream);
			data->innerstream = NULL;
		}
		efree(data);
		data = stream->abstract = NULL;
	}

	if (stream->wrapperdata) {
		zval_ptr_dtor(&stream->wrapperdata);
		stream->wrapperdata = NULL;
	}

	return 0;
}

php_stream_ops	oggvorbis_ops = {
	php_oggvorbis_write,
	php_oggvorbis_read,
	php_oggvorbis_close,
	NULL, /* flush */
	"OGGVORBIS",
	NULL, /* seek */
	NULL, /* cast */
	NULL, /* stat */
	NULL  /* set_option */
};

/* Ogg Vorbis Wrapper */

/* {{{ php_stream_oggvorbis_open
 */
php_stream * php_stream_oggvorbis_open(php_stream_wrapper *wrapper, char *path, char *mode, int options, char **opened_path, php_stream_context *context STREAMS_DC TSRMLS_DC)
{
	php_stream *stream = NULL, *innerstream = NULL;
	php_oggvorbis_data *data = NULL;
	zval **tmpzval = NULL;

	if (strlen(path) < 7) {
		if (options & REPORT_ERRORS) {
			php_error_docref(NULL TSRMLS_CC, E_WARNING, "Invalid path to Ogg Vorbis file (%s).", path);
		}
		return NULL;
	}

	if (strchr(mode, '+') || ((strchr(mode,'w') || strchr(mode, 'a')) && strchr(mode, 'r'))) {
		if (options & REPORT_ERRORS) {
			php_error_docref(NULL TSRMLS_CC, E_WARNING, "Invalid fopen mode.  Simultaneous read/write not permitted.");
		}
		return NULL;
	}

	if (strncasecmp("ogg://", path, 6)) {
		/* shouldn't happen */
		return NULL;
	}
	path += 6;

	innerstream = php_stream_open_wrapper_ex(path, mode, options, NULL, context);
	if (!innerstream) {
		if (options & REPORT_ERRORS) {
			php_error_docref(NULL TSRMLS_CC, E_WARNING, "Unable to open/create file (%s).", path);
		}
		return NULL;
	}

	data = emalloc(sizeof(php_oggvorbis_data));
	data->innerstream = innerstream;

	stream = php_stream_alloc(&oggvorbis_ops, data, NULL, mode);
	if (!stream) {
		if (options & REPORT_ERRORS) {
			php_error_docref(NULL TSRMLS_CC, E_WARNING, "Error allocating Ogg Vorbis stream.");
		}
		php_stream_close(innerstream);
		efree(data);
		return NULL;
	}
    php_stream_context_set(stream, context);
	stream->wrapperdata = NULL;

	if (strchr(mode, 'r')) {
		/* Initial State: Read(Decode) Mode
			We could let stream_read call ov_initstream, but calling here allows more meaningful error msg. */
		data->mode = OGGVORBIS_READ_HEADER;

		MAKE_STD_ZVAL(stream->wrapperdata);	
		array_init(stream->wrapperdata);

		ogg_sync_init(&(data->sync_state));

		if (php_oggvorbis_init_readstream(stream TSRMLS_CC) != SUCCESS) {
			/* Failure starting up stream */
			php_stream_close(innerstream);
			ogg_sync_clear(&(data->sync_state));
			efree(data);
			zval_ptr_dtor(&stream->wrapperdata);
			stream->wrapperdata = NULL;
			return NULL;
		}
	} else {
		/* Initial State: Write/Append(Encode) Mode */
		data->mode = OGGVORBIS_WRITE;

		if (php_oggvorbis_init_writestream(stream TSRMLS_CC) != SUCCESS) {
			/* Failure to create a new ogg stream */
			php_stream_close(innerstream);
			efree(data);
			return NULL;
		}
	}

	if (context &&
		php_stream_context_get_option(context, "ogg", "pcm_mode", &tmpzval) == SUCCESS &&
		tmpzval && *tmpzval &&
		Z_TYPE_PP(tmpzval) == IS_LONG) {
		data->pcm_mode = Z_LVAL_PP(tmpzval);
	} else {
		data->pcm_mode = OGGVORBIS_DEFAULT_PCM;
	}

	return stream;
}
/* }}} */

/* {{{ php_stream_oggvorbis_stat
 */
static int php_stream_oggvorbis_stat(php_stream_wrapper *wrapper,
        php_stream *stream,
        php_stream_statbuf *ssb
        TSRMLS_DC)
{
    /* For now, we return with a failure code to prevent the underlying
     * file's details from being used instead. */
    return -1;
}
/* }}} */

static php_stream_wrapper_ops oggvorbis_stream_wops = {
	php_stream_oggvorbis_open,
	NULL, /* stream_close */
	php_stream_oggvorbis_stat,
	NULL, /* stat_url */
	NULL, /* opendir */
	"OGG",
	NULL /* unlink */
};

PHPAPI php_stream_wrapper php_stream_oggvorbis_wrapper =  {
	&oggvorbis_stream_wops,
	NULL,
	0 /* is_url */
};

PHP_MINIT_FUNCTION(oggvorbis)
{
	REGISTER_LONG_CONSTANT("OGGVORBIS_PCM_U8",		OGGVORBIS_PCM_U8,		CONST_CS | CONST_PERSISTENT);
	REGISTER_LONG_CONSTANT("OGGVORBIS_PCM_S8",		OGGVORBIS_PCM_S8,		CONST_CS | CONST_PERSISTENT);
	REGISTER_LONG_CONSTANT("OGGVORBIS_PCM_U16_BE",	OGGVORBIS_PCM_U16_BE,	CONST_CS | CONST_PERSISTENT);
	REGISTER_LONG_CONSTANT("OGGVORBIS_PCM_U16_LE",	OGGVORBIS_PCM_U16_LE,	CONST_CS | CONST_PERSISTENT);
	REGISTER_LONG_CONSTANT("OGGVORBIS_PCM_S16_BE",	OGGVORBIS_PCM_S16_BE,	CONST_CS | CONST_PERSISTENT);
	REGISTER_LONG_CONSTANT("OGGVORBIS_PCM_S16_LE",	OGGVORBIS_PCM_S16_LE,	CONST_CS | CONST_PERSISTENT);

	return php_register_url_stream_wrapper("ogg", &php_stream_oggvorbis_wrapper TSRMLS_CC);;
}

PHP_MSHUTDOWN_FUNCTION(oggvorbis)
{
	return php_unregister_url_stream_wrapper("ogg" TSRMLS_CC);
}


PHP_MINFO_FUNCTION(oggvorbis)
{
	php_info_print_table_start();
	php_info_print_table_row(2, "Ogg Vorbis Wrapper", "enabled");
	php_info_print_table_end();
}

#endif /* WITH_OGGVORBIS */

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: sw=4 ts=4 fdm=marker
 * vim<600: sw=4 ts=4
 */
