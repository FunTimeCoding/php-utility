#!/bin/sh -e

DIRECTORY=$(dirname "${0}")
SCRIPT_DIRECTORY=$(cd "${DIRECTORY}" || exit 1; pwd)
# shellcheck source=/dev/null
. "${SCRIPT_DIRECTORY}/../configuration/project.sh"

if [ "${1}" = --help ]; then
    echo "Usage: ${0} [--ci-mode]"

    exit 0
fi

CONCERN_FOUND=false
CONTINUOUS_INTEGRATION_MODE=false

if [ "${1}" = --ci-mode ]; then
    shift
    mkdir -p build/log
    CONTINUOUS_INTEGRATION_MODE=true
fi

SYSTEM=$(uname)

if [ "${SYSTEM}" = Darwin ]; then
    FIND='gfind'
    UNIQ='guniq'
    SED='gsed'
    TEE='gtee'
else
    FIND='find'
    UNIQ='uniq'
    SED='sed'
    TEE='tee'
fi

MARKDOWN_FILES=$(${FIND} . -regextype posix-extended -name '*.md' -regex "${INCLUDE_FILTER}" -printf '%P\n')
DICTIONARY=en_US
mkdir -p tmp

if [ -d documentation/dictionary ]; then
    cat documentation/dictionary/*.dic > tmp/combined.dic
else
    touch tmp/combined.dic
fi

for FILE in ${MARKDOWN_FILES}; do
    WORDS=$(hunspell -d "${DICTIONARY}" -p tmp/combined.dic -l "${FILE}" | sort | ${UNIQ})

    if [ ! "${WORDS}" = '' ]; then
        echo "${FILE}"

        for WORD in ${WORDS}; do
            if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
                grep --line-number "${WORD}" "${FILE}"
            else
                # The equals character is required.
                grep --line-number --color=always "${WORD}" "${FILE}"
            fi
        done

        echo
    fi
done

TEX_FILES=$(${FIND} . -regextype posix-extended -name '*.tex' -regex "${INCLUDE_FILTER}" -printf '%P\n')

for FILE in ${TEX_FILES}; do
    WORDS=$(hunspell -d "${DICTIONARY}" -p tmp/combined.dic -l -t "${FILE}")

    if [ ! "${WORDS}" = '' ]; then
        echo "${FILE}"

        for WORD in ${WORDS}; do
            STARTS_WITH_DASH=$(echo "${WORD}" | grep -q '^-') || STARTS_WITH_DASH=false

            if [ "${STARTS_WITH_DASH}" = false ]; then
                if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
                    grep --line-number "${WORD}" "${FILE}"
                else
                    # The equals character is required.
                    grep --line-number --color=always "${WORD}" "${FILE}"
                fi
            else
                echo "Skip invalid: ${WORD}"
            fi
        done

        echo
    fi
done

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    FILES=$(${FIND} . -regextype posix-extended -name '*.sh' -regex "${INCLUDE_FILTER}" -printf '%P\n')

    for FILE in ${FILES}; do
        FILE_REPLACED=$(echo "${FILE}" | ${SED} 's/\//-/g')
        shellcheck --external-sources --format checkstyle "${FILE}" > "build/log/checkstyle-${FILE_REPLACED}.xml" || true
    done
fi

# shellcheck disable=SC2016
SHELL_SCRIPT_CONCERNS=$(${FIND} . -regextype posix-extended -name '*.sh' -regex "${INCLUDE_FILTER}" -exec sh -c 'shellcheck --external-sources ${1} || true' '_' '{}' \;)

if [ ! "${SHELL_SCRIPT_CONCERNS}" = '' ]; then
    CONCERN_FOUND=true
    echo "[WARNING] Shell script concerns:"
    echo "${SHELL_SCRIPT_CONCERNS}"
fi

# shellcheck disable=SC2016
EMPTY_FILES=$(${FIND} . -regextype posix-extended -type f -empty -regex "${INCLUDE_FILTER}")

if [ ! "${EMPTY_FILES}" = '' ]; then
    CONCERN_FOUND=true
    echo
    echo "[WARNING] Empty files:"
    echo
    echo "${EMPTY_FILES}"
fi

# shellcheck disable=SC2016
TO_DOS=$(${FIND} . -regextype posix-extended -type f -regex "${INCLUDE_FILTER}" -exec sh -c 'grep -Hrn TODO "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;)

if [ ! "${TO_DOS}" = '' ]; then
    echo
    echo "[INFO] To dos:"
    echo
    echo "${TO_DOS}"
fi

DUPLICATE_WORDS=$(cat documentation/dictionary/** | ${SED} '/^$/d' | sort | ${UNIQ} -cd)

if [ ! "${DUPLICATE_WORDS}" = '' ]; then
    CONCERN_FOUND=true
    echo
    echo "[WARNING] Duplicate words:"
    echo "${DUPLICATE_WORDS}"
fi

# shellcheck disable=SC2016
SHELLCHECK_DISABLES=$(${FIND} . -regextype posix-extended -type f -regex "${INCLUDE_FILTER}" -exec sh -c 'grep -Hrn "# shellcheck disable" "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;)

if [ ! "${SHELLCHECK_DISABLES}" = '' ]; then
    echo
    echo "[INFO] Shellcheck disables:"
    echo
    echo "${SHELLCHECK_DISABLES}"
fi

RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    mkdir -p build/log/mess_detector
    vendor/bin/phpmd src,test html .phpmd.xml --reportfile build/log/mess_detector/index.html || RETURN_CODE="${?}"
else
    OUTPUT=$(vendor/bin/phpmd src,test text .phpmd.xml) || RETURN_CODE="${?}"
fi

echo

# 0 means no mess detected.
if [ "${RETURN_CODE}" = 2 ]; then
    echo "(NOTICE) Mess detector violations found."
elif [ "${RETURN_CODE}" = 1 ]; then
    CONCERN_FOUND=true
    echo
    echo "(CRITICAL) Mess detector error occurred."
fi

echo
echo "${OUTPUT}"
echo
RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpstan analyse --configuration .phpstan.neon --no-progress --memory-limit 1G --error-format checkstyle --level max src test web > build/log/checkstyle-phpstan.xml || RETURN_CODE="${?}"
    # TODO: What to do with this return code?
fi

OUTPUT=$(vendor/bin/phpstan analyse --configuration .phpstan.neon --no-progress --memory-limit 1G --no-ansi --level max src test web) && FOUND=false || FOUND=true

if [ "${FOUND}" = true ]; then
    echo
    echo "(NOTICE) PhpStan concerns found."
    echo
    echo "${OUTPUT}"
fi

RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpcs --report=checkstyle --report-file=build/log/checkstyle-result.xml --standard=PSR12 src test || RETURN_CODE="${?}"
else
    vendor/bin/phpcs --standard=PSR12 src test || RETURN_CODE="${?}"
fi

if [ ! "${RETURN_CODE}" = 0 ]; then
    echo "(NOTICE) Code sniffer concerns found."
    echo
fi

RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpcpd --log-pmd build/log/pmd-cpd.xml src test || RETURN_CODE="${?}"
    # TODO: What to do with this return code?
fi

vendor/bin/phpcpd src test

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    mkdir -p build/pdepend
    vendor/bin/pdepend --jdepend-xml=build/log/jdepend.xml --summary-xml=build/log/jdepend-summary.xml --jdepend-chart=build/pdepend/dependencies.svg --overview-pyramid=build/pdepend/pyramid.svg src,test
fi

echo

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/php-cs-fixer --no-ansi fix --config .php_cs.php --dry-run | ${TEE} build/log/php-cs-fixer.txt
else
    vendor/bin/php-cs-fixer --no-ansi fix --config .php_cs.php
fi

echo
RETURN_CODE=0

# TODO: Remove this and upgrade phan once the php-ast package is available in version 1.0 or higher.
export PHAN_SUPPRESS_AST_UPGRADE_NOTICE=1
export PHAN_DISABLE_XDEBUG_WARN=1

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phan --output-mode checkstyle | ${TEE} build/log/checkstyle-phan.xml || RETURN_CODE="${?}"
else
    vendor/bin/phan || RETURN_CODE="${?}"
fi

if [ ! "${RETURN_CODE}" = 0 ]; then
    CONCERN_FOUND=true
    echo "Phan concerns found."
    echo
fi

echo
RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/psalm --no-progress --show-info=false --report=build/log/psalm.txt || RETURN_CODE="${?}"
else
    vendor/bin/psalm --no-progress --show-info=false || RETURN_CODE="${?}"
fi

if [ ! "${RETURN_CODE}" = 0 ]; then
    CONCERN_FOUND=true
    echo "Psalm concerns found."
    echo
fi

echo
RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/infection --no-progress --no-ansi || RETURN_CODE="${?}"
else
    vendor/bin/infection --no-progress || RETURN_CODE="${?}"
fi

if [ ! "${RETURN_CODE}" = 0 ]; then
    CONCERN_FOUND=true
    echo "Infection concerns found."
    echo
fi

echo
RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/composer-require-checker --no-ansi || RETURN_CODE="${?}"
else
    vendor/bin/composer-require-checker || RETURN_CODE="${?}"
fi

if [ ! "${RETURN_CODE}" = 0 ]; then
    CONCERN_FOUND=true
    echo "Require checker concerns found."
    echo
fi

# TODO: This finds that php is unused. Why?
#script/php/unused.sh

# TODO: Wait for dependency tracker to leave alpha status.
#script/php/track-dependencies.sh

if [ "${CONCERN_FOUND}" = true ]; then
    echo
    echo "Warning level concern(s) found." >&2

    exit 2
fi
