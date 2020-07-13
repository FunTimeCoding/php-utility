#!/bin/bash -e

PHP_VERSION="${1}"

if [ "${PHP_VERSION}" = "" ]; then
    echo "Usage: ${0} PHP_VERSION"

    exit 1
fi

PHPBREW_CONFIGURATION="${HOME}/.phpbrew/bashrc"

if [ -f "${PHPBREW_CONFIGURATION}" ]; then
    # shellcheck source=/dev/null
    . "${PHPBREW_CONFIGURATION}"
fi

phpbrew use "php-${PHP_VERSION}"
SYSTEM=$(uname)

if [ "${SYSTEM}" = Darwin ]; then
    phpbrew ext install memcached -- --with-libmemcached-dir=/usr/local/opt/libmemcached --with-openssl-dir=/usr/local/opt/openssl
else
    phpbrew ext install memcached
fi
