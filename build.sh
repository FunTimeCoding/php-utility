#!/bin/sh -e

if [ ! -f "composer.phar" ]; then
    curl -sS https://getcomposer.org/installer | php -- --install-dir=. --filename=composer.phar --disable-tls
fi

composer.phar selfupdate
composer.phar install --no-interaction --no-progress
rm -rf build
./run-style-check.sh --ci-mode
./run-tests.sh --ci-mode
./run-metrics.sh --ci-mode
