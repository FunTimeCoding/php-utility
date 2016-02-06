#!/bin/sh -e

DIRECTORY=$(dirname "${0}")
SCRIPT_DIRECTORY=$(cd "${DIRECTORY}"; pwd)
FILES="build"

for FILE in ${FILES}; do
    if [ -e "${FILE}" ]; then
        echo "rm -rf ${FILE}"
        rm -rf "${SCRIPT_DIRECTORY:?}/${FILE}"
    fi
done
