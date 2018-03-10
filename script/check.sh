#!/bin/sh -e

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
else
    FIND='find'
fi

EXCLUDE_FILTER='^.*\/(build|tmp|vendor|\.git|\.vagrant|\.idea)\/.*$'
MARKDOWN_FILES=$(${FIND} . -type f -name '*.md' -regextype posix-extended ! -regex "${EXCLUDE_FILTER}")
BLACKLIST=""
DICTIONARY=en_US
mkdir -p tmp
cat documentation/dictionary/*.dic > tmp/combined.dic

for FILE in ${MARKDOWN_FILES}; do
    WORDS=$(hunspell -d "${DICTIONARY}" -p tmp/combined.dic -l "${FILE}" | sort | uniq)

    if [ ! "${WORDS}" = "" ]; then
        echo "${FILE}"

        for WORD in ${WORDS}; do
            BLACKLISTED=$(echo "${BLACKLIST}" | grep "${WORD}") || BLACKLISTED=false

            if [ "${BLACKLISTED}" = false ]; then
                if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
                    grep --line-number "${WORD}" "${FILE}"
                else
                    # The equals character is required.
                    grep --line-number --color=always "${WORD}" "${FILE}"
                fi
            else
                echo "Blacklisted word: ${WORD}"
            fi
        done

        echo
    fi
done

TEX_FILES=$(${FIND} . -type f -name '*.tex' -regextype posix-extended ! -regex "${EXCLUDE_FILTER}")

for FILE in ${TEX_FILES}; do
    WORDS=$(hunspell -d "${DICTIONARY}" -p tmp/combined.dic -l -t "${FILE}")

    if [ ! "${WORDS}" = "" ]; then
        echo "${FILE}"

        for WORD in ${WORDS}; do
            STARTS_WITH_DASH=$(echo "${WORD}" | grep -q '^-') || STARTS_WITH_DASH=false

            if [ "${STARTS_WITH_DASH}" = false ]; then
                BLACKLISTED=$(echo "${BLACKLIST}" | grep "${WORD}") || BLACKLISTED=false

                if [ "${BLACKLISTED}" = false ]; then
                    if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
                        grep --line-number "${WORD}" "${FILE}"
                    else
                        # The equals character is required.
                        grep --line-number --color=always "${WORD}" "${FILE}"
                    fi
                else
                    echo "Skip blacklisted: ${WORD}"
                fi
            else
                echo "Skip invalid: ${WORD}"
            fi
        done

        echo
    fi
done

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    FILES=$(${FIND} . -name '*.sh' -regextype posix-extended ! -regex "${EXCLUDE_FILTER}" -printf '%P\n')

    for FILE in ${FILES}; do
        FILE_REPLACED=$(echo "${FILE}" | sed 's/\//-/g')
        shellcheck --format checkstyle "${FILE}" > "build/log/checkstyle-${FILE_REPLACED}.xml" || true
    done
else
    # shellcheck disable=SC2016
    SHELL_SCRIPT_CONCERNS=$(${FIND} . -name '*.sh' -regextype posix-extended ! -regex "${EXCLUDE_FILTER}" -exec sh -c 'shellcheck ${1} || true' '_' '{}' \;)

    if [ ! "${SHELL_SCRIPT_CONCERNS}" = "" ]; then
        CONCERN_FOUND=true
        echo
        echo "(WARNING) shellcheck concerns found."
        echo
        echo "${SHELL_SCRIPT_CONCERNS}"
    fi
fi

# shellcheck disable=SC2016
EMPTY_FILES=$(${FIND} . -empty -regextype posix-extended ! -regex "${EXCLUDE_FILTER}")

if [ ! "${EMPTY_FILES}" = "" ]; then
    CONCERN_FOUND=true

    if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
        echo "${EMPTY_FILES}" > build/log/empty-files.txt
    else
        echo
        echo "(WARNING) Empty files found."
        echo
        echo "${EMPTY_FILES}"
    fi
fi

# shellcheck disable=SC2016
TO_DOS=$(${FIND} . -regextype posix-extended -type f -and ! -regex "${EXCLUDE_FILTER}" -exec sh -c 'grep -Hrn TODO "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;)

if [ ! "${TO_DOS}" = "" ]; then
    if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
        echo "${TO_DOS}" > build/log/to-dos.txt
    else
        echo
        echo "(NOTICE) To dos found."
        echo
        echo "${TO_DOS}"
    fi
fi

# shellcheck disable=SC2016
SHELLCHECK_IGNORES=$(${FIND} . -regextype posix-extended -type f -and ! -regex "${EXCLUDE_FILTER}" -exec sh -c 'grep -Hrn "# shellcheck" "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;)

if [ ! "${SHELLCHECK_IGNORES}" = "" ]; then
    if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
        echo "${SHELLCHECK_IGNORES}" > build/log/shellcheck-ignores.txt
    else
        echo
        echo "(NOTICE) Shellcheck ignores found."
        echo
        echo "${SHELLCHECK_IGNORES}"
    fi
fi

RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpmd src,test xml .phpmd.xml --reportfile build/log/pmd-pmd.xml || RETURN_CODE="${?}"
else
    OUTPUT=$(vendor/bin/phpmd src,test text .phpmd.xml) || RETURN_CODE="${?}"
fi

# 0 means no mess detected.
if [ "${RETURN_CODE}" = 2 ]; then
    CONCERN_FOUND=true
    echo
    echo "(WARNING) Mess detector violations found."
    echo
    if [ "${CONTINUOUS_INTEGRATION_MODE}" = false ]; then
        echo "${OUTPUT}"
    fi

    echo
elif [ "${RETURN_CODE}" = 1 ]; then
    CONCERN_FOUND=true
    echo
    echo "(CRITICAL) Mess detector error occurred."
    echo
    if [ "${CONTINUOUS_INTEGRATION_MODE}" = false ]; then
        echo "${OUTPUT}"
    fi

    echo
fi

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpstan analyse --configuration .phpstan.neon --no-progress --errorFormat checkstyle --level max src test > build/log/checkstyle-phpstan.xml
else
    OUTPUT=$(vendor/bin/phpstan analyse --configuration .phpstan.neon --no-progress --no-ansi --level max src test) && FOUND=false || FOUND=true

    if [ "${FOUND}" = true ]; then
        CONCERN_FOUND=true
        echo
        echo "(WARNING) PhpStan concerns found."
        echo
        echo "${OUTPUT}"
    fi
fi

RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpcs --report=checkstyle --report-file=build/log/checkstyle-result.xml --standard=PSR2 src test || RETURN_CODE="${?}"
else
    vendor/bin/phpcs --standard=PSR2 src test || RETURN_CODE="${?}"
fi

if [ ! "${RETURN_CODE}" = 0 ]; then
    CONCERN_FOUND=true
    echo "Code sniffer concerns found."
    echo
fi

echo

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpcpd --log-pmd build/log/pmd-cpd.xml src test
else
    vendor/bin/phpcpd src test
fi

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    mkdir -p build/pdepend
    vendor/bin/pdepend --jdepend-xml=build/log/jdepend.xml --summary-xml=build/log/jdepend-summary.xml --jdepend-chart=build/pdepend/dependencies.svg --overview-pyramid=build/pdepend/pyramid.svg src,test
fi

echo

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/php-cs-fixer --no-ansi fix --config .php_cs.php --dry-run | tee build/log/php-cs-fixer.txt
else
    vendor/bin/php-cs-fixer --no-ansi fix --config .php_cs.php
fi

if [ "${CONCERN_FOUND}" = true ]; then
    echo
    echo "Concern(s) of category WARNING found." >&2

    exit 2
fi
