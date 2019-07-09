#!/bin/sh -e

rm -rf build

if [ -f composer.phar ]; then
    php composer.phar install --no-interaction --no-progress
else
    composer install --no-interaction --no-progress
fi

script/check.sh --ci-mode
# Run test before measure so that SonarQube can read the PHPUnit coverage.
script/test.sh --ci-mode
script/measure.sh --ci-mode

# TODO: Package for Debian.
#SYSTEM=$(uname)
#
#if [ "${SYSTEM}" = Linux ]; then
#    script/debian/package.sh
#fi

# TODO: Finish implementation.
#script/docker/build.sh
