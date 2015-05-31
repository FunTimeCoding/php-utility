#!/bin/sh -e

if [ "${1}" = "--ci-mode" ]; then
    shift
    mkdir -p build/log
    vendor/bin/phploc --count-tests src test | tee build/log/phploc.txt
    sonar-runner | tee build/log/sonar-runner.txt
    rm -rf .sonar
else
    vendor/bin/phploc --count-tests src test
fi
