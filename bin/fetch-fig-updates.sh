#!/bin/sh -e

DIRECTORY=$(dirname "${0}")
SCRIPT_DIRECTORY=$(
    cd "${DIRECTORY}" || exit 1
    pwd
)
TEMPORARY_DIRECTORY="${SCRIPT_DIRECTORY}/../tmp"
FIG_CLONE="${TEMPORARY_DIRECTORY}/fig-standards"

if [ ! -d "${FIG_CLONE}" ]; then
    git clone https://github.com/php-fig/fig-standards "${FIG_CLONE}"
fi

cd "${FIG_CLONE}"
HEAD_HASH_FILE="${TEMPORARY_DIRECTORY}/head-fig-git-commit-hash.txt"

if [ -f "${HEAD_HASH_FILE}" ]; then
    HEAD_HASH=$(cat "${HEAD_HASH_FILE}")
fi

git pull --quiet
OUTPUT=$(git --no-pager log -5 --oneline -- accepted)
NEW_HEAD_HASH=$(echo "${OUTPUT}" | head -n 1 | awk '{ print $1 }')

if [ "${HEAD_HASH}" = "${NEW_HEAD_HASH}" ]; then
    echo "No change."
else
    echo "Change detected."
    echo "${NEW_HEAD_HASH}" >"${HEAD_HASH_FILE}"
    git --no-pager log -5 --oneline -- accepted
fi
