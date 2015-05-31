#!/bin/sh -e

echo "Deleting cached and generated files."
DIR=$(dirname "${0}")
SCRIPT_DIR=$(cd "${DIR}"; pwd)
FILES="build .sonar"

for FILE in ${FILES}; do
    if [ -e "${FILE}" ]; then
        echo "rm -rf ${FILE}"
        rm -rf "${SCRIPT_DIR:?}/${FILE}"
    fi
done
