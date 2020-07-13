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
    export PHP_AUTOCONF=/usr/local/bin/autoconf
    export PHP_AUTOHEADER=/usr/local/bin/autoheader
    phpbrew ext install amqp -- --with-librabbitmq-dir=/usr/local/opt/rabbitmq-c
else
    phpbrew ext install amqp
fi
