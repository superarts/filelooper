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

#ifndef PHP_OGGVORBIS_H
#define PHP_OGGVORBIS_H

#if WITH_OGGVORBIS

#define OGGVORBIS_CHUNK_SIZE	4096

extern zend_module_entry oggvorbis_module_entry;
#define phpext_oggvorbis_ptr &oggvorbis_module_entry

PHP_MINIT_FUNCTION(oggvorbis);
PHP_MSHUTDOWN_FUNCTION(oggvorbis);
PHP_MINFO_FUNCTION(oggvorbis);


#else

#define phpext_oggvorbis_ptr NULL

#endif /* WITH_OGGVORBIS */

#endif /* PHP_OGGVORBIS_H */
