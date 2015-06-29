#!/bin/sh -e

if [ "${1}" = "--ci-mode" ]; then
    shift
    mkdir -p build/log
    vendor/bin/phpunit --testsuite unit -c .phpunit.ci.xml
else
    SUITE="unit"

    if [ ! "${1}" = "" ]; then
        SUITE="${1}"
        shift
    fi

    echo "Test suite: ${SUITE}"
    vendor/bin/phpunit --testsuite "${SUITE}" "$@"
fi
