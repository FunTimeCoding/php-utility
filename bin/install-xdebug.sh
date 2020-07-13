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
SHORT_PHP_VERSION=$(echo "${PHP_VERSION}" | awk '{ print substr($0, 1, 3) }')

if [ "${SHORT_PHP_VERSION}" = 5.3 ]; then
    phpbrew ext known xdebug
    phpbrew ext install --pecl xdebug 2.2.7
elif [ "${SHORT_PHP_VERSION}" = 5.4 ]; then
    phpbrew ext known xdebug
    phpbrew ext install --pecl xdebug 2.4.1
elif [ "${SHORT_PHP_VERSION}" = 5.6 ]; then
    phpbrew ext known xdebug
    phpbrew ext install --pecl xdebug 2.5.5
else
    phpbrew ext install xdebug
fi
