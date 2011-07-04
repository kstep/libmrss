AC_INIT(src/mrss_generic.c)

LIBMRSS_MAJOR_VERSION=0
LIBMRSS_MINOR_VERSION=19
LIBMRSS_MICRO_VERSION=2
LIBMRSS_VERSION=$LIBMRSS_MAJOR_VERSION.$LIBMRSS_MINOR_VERSION.$LIBMRSS_MICRO_VERSION
LIBMRSS_VERSION_INFO=`expr $LIBMRSS_MAJOR_VERSION + $LIBMRSS_MINOR_VERSION`:$LIBMRSS_MICRO_VERSION:$LIBMRSS_MINOR_VERSION
VERSION=${LIBMRSS_VERSION}

AM_SANITY_CHECK
AM_INIT_AUTOMAKE(libmrss,$VERSION)
AM_CONFIG_HEADER(config.h)
AM_MAINTAINER_MODE

AC_PROG_CC
AC_GNU_SOURCE
AC_ISC_POSIX
AC_PROG_RANLIB
AC_PROG_LIBTOOL
AC_PROG_INSTALL
AM_PROG_CC_STDC

AC_HEADER_STDC
AC_HEADER_DIRENT

AC_CHECK_HEADER(curl/curl.h,, AC_MSG_ERROR(libcurl is required to compile libmrss))
AC_CHECK_LIB(curl,curl_version,, AC_MSG_ERROR(libcurl is required to compile libmrss))

PKG_CHECK_MODULES(NXML, nxml >= 0.18 , nxml=yes, nxml=no)

if test "$nxml" = no; then
  AC_MSG_ERROR(libnXML is required to compile libmrss!)
fi

# LOCALE CHECKS...
AC_MSG_CHECKING(for locale enviroment)

AH_TEMPLATE([USE_LOCALE], [Define to 1 if we can use locale])
AH_TEMPLATE([USE_X_LOCALE], [Define to 1 if this is a macosx or xlocale compatible OS])
AH_TEMPLATE([USE_GENERIC_LOCALE], [Define to 1 if this is a generic OS with locale support])

AC_TRY_COMPILE([
  #include <xlocale.h>
  ], [newlocale (LC_ALL_MASK, "C", NULL)],
  x_locale=yes, x_locale=no)

if test "$x_locale" = "yes"; then
  AC_DEFINE(USE_X_LOCALE)
  AC_DEFINE(USE_LOCALE)
  use_locale=yes
fi

AC_TRY_COMPILE([
  #include <locale.h>
  ], [newlocale (LC_ALL_MASK, "C", NULL)],
  generic_locale=yes, generic_locale=no)

if test "$generic_locale" = "yes"; then
  AC_DEFINE(USE_GENERIC_LOCALE)
  AC_DEFINE(USE_LOCALE)
  use_locale=yes
fi

if test "$use_locale" = "yes"; then
  AC_MSG_RESULT(yes)
else
  AC_MSG_RESULT(no)
fi

LDFLAGS="$LDFLAGS $NXML_LIBS"
CFLAGS="$CFLAGS $NXML_CFLAGS -Wall"

AC_SUBST(LIBMRSS_VERSION)
AC_SUBST(LIBMRSS_VERSION_INFO)

AC_SUBST(LIBMRSS_MAJOR_VERSION)
AC_SUBST(LIBMRSS_MINOR_VERSION)
AC_SUBST(LIBMRSS_MICRO_VERSION)

AC_OUTPUT([
Makefile
src/mrss.h
src/Makefile
test/Makefile
doc/Makefile
phpmrss/Makefile
mrss.pc
doxy.conf
])

