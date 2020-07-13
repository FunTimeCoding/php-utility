#!/bin/sh -e

OPERATING_SYSTEM=$(uname)

if [ "${OPERATING_SYSTEM}" = Darwin ]; then
    brew install libcouchbase
fi

phpbrew ext known couchbase
phpbrew ext install couchbase
