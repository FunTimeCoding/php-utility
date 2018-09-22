#!/bin/sh -e

rm -rf build

if [ -f composer.phar ]; then
    php composer.phar install --no-interaction --no-progress
else
    composer install --no-interaction --no-progress
fi

script/check.sh --ci-mode
script/measure.sh --ci-mode
script/test.sh --ci-mode
# TODO: Finish implementation, then uncomment.
#script/docker/build.sh
