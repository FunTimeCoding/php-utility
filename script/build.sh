#!/bin/sh -e

rm -rf build
composer install --no-interaction --no-progress
script/check.sh --ci-mode
script/measure.sh --ci-mode
script/test.sh --ci-mode
# TODO: Finish implementation, then uncomment.
#script/docker/build.sh
