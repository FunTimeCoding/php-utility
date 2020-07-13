#!/bin/sh -e

SYSTEM=$(uname)

if [ "${SYSTEM}" = 'Darwin' ]; then
    COMPOSER_INSTALLED=false
else
    dpkg --list | grep --quiet 'ii  composer' && COMPOSER_INSTALLED=true || COMPOSER_INSTALLED=false
fi

if [ "${COMPOSER_INSTALLED}" = true ]; then
    COMPOSER='composer'
else
    COMPOSER="php ${HOME}/src/php-tools/composer.phar"

    if [ ! -f "${COMPOSER}" ]; then
        wget --output-document "${COMPOSER}" https://getcomposer.org/download/1.9.0/composer.phar
        chmod +x "${COMPOSER}"
    fi

    ${COMPOSER} selfupdate
fi

${COMPOSER} global update
