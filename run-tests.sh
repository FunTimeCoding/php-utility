#!/bin/sh -e

if [ "${1}" = "--ci-mode" ]; then
    shift
    mkdir -p build/log
    vendor/bin/phpunit --testsuite unit -c .phpunit.ci.xml
else
    vendor/bin/phpunit --testsuite unit --coverage-text "$@"
fi
