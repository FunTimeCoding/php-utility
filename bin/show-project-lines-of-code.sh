#!/bin/sh -e

SYSTEM=$(uname)

if [ "${SYSTEM}" = Darwin ]; then
    FIND='gfind'
else
    FIND='find'
fi

${FIND} . -name '*.php' -exec cat {} \; | wc -l
