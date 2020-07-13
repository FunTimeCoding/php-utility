#!/bin/sh -e

SYSTEM=$(uname)

if [ "${SYSTEM}" = Darwin ]; then
    FIND='gfind'
else
    FIND='find'
fi

${FIND} . -name '*.php' | xargs perl -pi -e 's/(?!(<\?(php|xml|=)))<\?/<\?php/g;'
