#!/bin/sh -e

COMPOSER_MISSING=false

if [ "$(command -v composer || true)" = "" ]; then
    if [ "$(command -v composer.phar || true)" = "" ]; then
        if [ -f composer.phar ]; then
            COMPOSER_COMMAND=./composer.phar
        else
            COMPOSER_MISSING=true
        fi
    else
        COMPOSER_COMMAND=composer.phar
    fi
else
    COMPOSER_COMMAND=composer
fi

if [ "${COMPOSER_MISSING}" = true ]; then
    EXPECTED_SIGNATURE=$(curl --silent https://composer.github.io/installer.sig)
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    ACTUAL_SIGNATURE=$(php -r "echo hash_file('SHA384', 'composer-setup.php');")

    if [ ! "${EXPECTED_SIGNATURE}" = "${ACTUAL_SIGNATURE}" ]; then
        rm composer-setup.php

        exit 1
    fi

    php composer-setup.php --quiet
    rm composer-setup.php
    COMPOSER_COMMAND=./composer.phar
fi

${COMPOSER_COMMAND} install
