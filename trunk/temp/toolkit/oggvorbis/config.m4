AC_DEFUN([PKG_CHECK_MODULES], [
  succeeded=no

  if test -z "$PKG_CONFIG"; then
    AC_PATH_PROG(PKG_CONFIG, pkg-config, no)
  fi

  if test "$PKG_CONFIG" = "no" ; then
    echo "*** The pkg-config script could not be found. Make sure it
is"
    echo "*** in your path, or set the PKG_CONFIG environment variable"
    echo "*** to the full path to pkg-config."
    echo "*** Or see http://www.freedesktop.org/software/pkgconfig to
get pkg-config."
  else
    PKG_CONFIG_MIN_VERSION=0.9.0
    if $PKG_CONFIG --atleast-pkgconfig-version $PKG_CONFIG_MIN_VERSION;
then
      AC_MSG_CHECKING(for $2)

      if $PKG_CONFIG --exists "$2" ; then
        AC_MSG_RESULT(yes)
        succeeded=yes

        AC_MSG_CHECKING($1_CFLAGS)
        $1_CFLAGS=`$PKG_CONFIG --cflags "$2"`
        AC_MSG_RESULT($$1_CFLAGS)

        AC_MSG_CHECKING($1_LIBS)
        $1_LIBS=`$PKG_CONFIG --libs "$2"`
        AC_MSG_RESULT($$1_LIBS)
      else
        $1_CFLAGS=""
        $1_LIBS=""
        ## If we have a custom action on failure, don't print errors,
but
        ## do set a variable so people can do so.
        $1_PKG_ERRORS=`$PKG_CONFIG --errors-to-stdout --print-errors
"$2"`
        ifelse([$4], ,echo $$1_PKG_ERRORS,)
      fi

      AC_SUBST($1_CFLAGS)
      AC_SUBST($1_LIBS)
    else
      echo "*** Your version of pkg-config is too old. You need version
$PKG_CONFIG_MIN_VERSION or newer."
      echo "*** See http://www.freedesktop.org/software/pkgconfig"
    fi
  fi

  if test $succeeded = yes; then
    ifelse([$3], , :, [$3])
  else
    ifelse([$4], , AC_MSG_ERROR([Library requirements ($2) not met;
consider adjusting the PKG_CONFIG_PATH environment variable if your
libraries are in a nonstandard prefix so pkg-config can find them.]),
[$4])
  fi
 ])

PHP_ARG_ENABLE(oggvorbis, whether to enable the Ogg Vorbis stream
wrapper,
[  --enable-oggvorbis      Enable PHP ogg.vorbis:// wrapper.])

if test "$PHP_OGGVORBIS" == "yes"; then
  AC_DEFINE(WITH_OGGVORBIS, 1, [Whether you want Ogg Vorbis Support])

  PKG_CHECK_MODULES(OGG, [ogg >= 1])
  PHP_EVAL_LIBLINE($OGG_LIBS, OGGVORBIS_SHARED_LIBADD)
  OGGVORBIS_CFLAGS="$OGGVORBIS_CFLAGS $OGG_CFLAGS"
  OGGVORBIS_SHARED_LIBADD="$OGGVORBIS_SHARED_LIBADD $OGG_LIBS"

  for i in /usr/local /usr; do
    if [[ -r $i/include/ogg/ogg.h ]]; then
      OGG_DIR=$i
      OGG_INC_DIR=$i/include/ogg
      break
    elif [[ -r $i/include/ogg.h ]]; then
      OGG_DIR=$i
      OGG_INC_DIR=$i/include
      break
    fi
  done
  PHP_ADD_INCLUDE($OGG_INC_DIR)

  PKG_CHECK_MODULES(VORBIS, [vorbis >= 1])
  PHP_EVAL_LIBLINE($VORBIS_LIBS, OGGVORBIS_SHARED_LIBADD)
  OGGVORBIS_CFLAGS="$OGGVORBIS_CFLAGS $VORBIS_CFLAGS"
  OGGVORBIS_SHARED_LIBADD="$OGGVORBIS_SHARED_LIBADD $VORBIS_LIBS"
  PKG_CHECK_MODULES(VORBISENC, [vorbisfile >= 1])
  PHP_EVAL_LIBLINE($VORBISENC_LIBS, OGGVORBIS_SHARED_LIBADD)
  OGGVORBIS_CFLAGS="$OGGVORBIS_CFLAGS $VORBISENC_CFLAGS"
  OGGVORBIS_SHARED_LIBADD="$OGGVORBIS_SHARED_LIBADD $VORBISENC_LIBS"
  PKG_CHECK_MODULES(VORBISFILE, [vorbisenc >= 1])
  PHP_EVAL_LIBLINE($VORBISFILE_LIBS, OGGVORBIS_SHARED_LIBADD)
  OGGVORBIS_CFLAGS="$OGGVORBIS_CFLAGS $VORBISFILE_CFLAGS"
  OGGVORBIS_SHARED_LIBADD="$OGGVORBIS_SHARED_LIBADD $VORBISFILE_LIBS"

  for i in /usr/local /usr; do
    if [[ -r $i/include/vorbis/vorbisfile.h ]]; then
      VORBIS_DIR=$i
      VORBIS_INC_DIR=$i/include/vorbis
      break
    elif [[ -r $i/include/vorbisfile.h ]]; then
      VORBIS_DIR=$i
      VORBIS_INC_DIR=$i/include
      break
    fi
  done
  PHP_ADD_INCLUDE($VORBIS_INC_DIR)

  PHP_NEW_EXTENSION(oggvorbis, oggvorbis.c, $ext_shared, ,
$OGGVORBIS_CFLAGS)

  PHP_SUBST(OGGVORBIS_SHARED_LIBADD)
fi
