#!/bin/sh -e

SYSTEM=$(uname)

if [ "${SYSTEM}" = 'Darwin' ]; then
    FIND='gfind'
else
    FIND='find'
fi

${FIND} "${HOME}/src" -maxdepth 2 -name composer.phar -exec sh -c 'echo ${1} && php ${1} selfupdate' '_' '{}' \;
