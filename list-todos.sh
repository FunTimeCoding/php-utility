#!/bin/sh -e

OPERATING_SYSTEM=$(uname)

if [ "${OPERATING_SYSTEM}" = "Linux" ]; then
    FIND="find"
else
    FIND="gfind"
fi

echo "To dos"
# shellcheck disable=SC2016
${FIND} . -regextype posix-extended -type f -and ! -regex '^.*/(build|vendor|\.git|\.vim|\.idea)/.*$' -exec sh -c 'grep -Hrn TODO "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;
echo
echo "ShellCheck ignored warnings"
# shellcheck disable=SC2016
${FIND} . -regextype posix-extended -type f -and ! -regex '^.*/(build|vendor|\.git|\.vim|\.idea)/.*$' -exec sh -c 'grep -Hrn "# shellcheck" "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;
echo
echo "PHPMD ignored warnings"
# shellcheck disable=SC2016
${FIND} . -regextype posix-extended -type f -and ! -regex '^.*/(build|vendor|\.git|\.vim|\.idea)/.*$' -exec sh -c 'grep -Hrn "@SuppressWarnings" "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;
