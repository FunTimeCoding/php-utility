#!/bin/bash -e

PHP_VERSION="${1}"

if [ "${PHP_VERSION}" = '' ]; then
    usage

    exit 1
fi

PHPBREW_CONFIGURATION="${HOME}/.phpbrew/bashrc"

if [ -f "${PHPBREW_CONFIGURATION}" ]; then
    # shellcheck source=/dev/null
    . "${PHPBREW_CONFIGURATION}"
fi

phpbrew known --update --old
SYSTEM=$(uname)

if [ "${SYSTEM}" = Darwin ]; then
    # LDFLAGS is a workaround for off_t undefined.
    LDFLAGS="-L/Library/Developer/CommandLineTools/SDKs/MacOSX.sdk/usr/lib/system" phpbrew --quiet install --mirror=https://www.php.net "${PHP_VERSION}" +default +mysql +apxs2 -- --with-bz2=/usr/local/opt/bzip2 --with-curl=/usr/local/opt/curl --with-zlib-dir=/usr/local/opt/zlib
else
    SHORT_PHP_VERSION=$(echo "${PHP_VERSION}" | awk '{ print substr($0, 1, 3) }')

    if [ "${SHORT_PHP_VERSION}" = 5.4 ]; then
        phpbrew --quiet install --mirror=https://www.php.net "${PHP_VERSION}" +default -openssl
    else
        phpbrew --quiet install --mirror=https://www.php.net "${PHP_VERSION}" +default +mysql
    fi
fi
