#!/bin/sh -e

DIRECTORY=$(dirname "${0}")
SCRIPT_DIRECTORY=$(cd "${DIRECTORY}" || exit 1; pwd)
# shellcheck source=/dev/null
. "${SCRIPT_DIRECTORY}/../lib/project.sh"

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
else
    FIND='find'
    UNIQ='uniq'
    SED='sed'
fi

MARKDOWN_FILES=$(${FIND} . -regextype posix-extended -name '*.md' ! -regex "${EXCLUDE_FILTER}" -printf '%P\n')
BLACKLIST=''
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

TEX_FILES=$(${FIND} . -regextype posix-extended -name '*.tex' ! -regex "${EXCLUDE_FILTER}" -printf '%P\n')

for FILE in ${TEX_FILES}; do
    WORDS=$(hunspell -d "${DICTIONARY}" -p tmp/combined.dic -l -t "${FILE}")

    if [ ! "${WORDS}" = '' ]; then
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
    FILES=$(${FIND} . -regextype posix-extended -name '*.sh' ! -regex "${EXCLUDE_FILTER}" -printf '%P\n')

    for FILE in ${FILES}; do
        FILE_REPLACED=$(echo "${FILE}" | ${SED} 's/\//-/g')
        shellcheck --format checkstyle "${FILE}" > "build/log/checkstyle-${FILE_REPLACED}.xml" || true
    done
else
    # shellcheck disable=SC2016
    SHELL_SCRIPT_CONCERNS=$(${FIND} . -regextype posix-extended -name '*.sh' ! -regex "${EXCLUDE_FILTER}" -exec sh -c 'shellcheck ${1} || true' '_' '{}' \;)

    if [ ! "${SHELL_SCRIPT_CONCERNS}" = '' ]; then
        CONCERN_FOUND=true
        echo "(WARNING) Shell script concerns:"
        echo "${SHELL_SCRIPT_CONCERNS}"
    fi
fi

# shellcheck disable=SC2016
EMPTY_FILES=$(${FIND} . -regextype posix-extended -type f -empty ! -regex "${EXCLUDE_FILTER}")

if [ ! "${EMPTY_FILES}" = '' ]; then
    CONCERN_FOUND=true

    if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
        echo "${EMPTY_FILES}" > build/log/empty-files.txt
    else
        echo
        echo "(WARNING) Empty files:"
        echo
        echo "${EMPTY_FILES}"
    fi
fi

# shellcheck disable=SC2016
TO_DOS=$(${FIND} . -regextype posix-extended -type f ! -regex "${EXCLUDE_FILTER}" -exec sh -c 'grep -Hrn TODO "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;)

if [ ! "${TO_DOS}" = '' ]; then
    if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
        echo "${TO_DOS}" > build/log/to-dos.txt
    else
        echo
        echo "(NOTICE) To dos:"
        echo
        echo "${TO_DOS}"
    fi
fi

DUPLICATE_WORDS=$(cat documentation/dictionary/** | ${SED} '/^$/d' | sort | ${UNIQ} -cd)

if [ ! "${DUPLICATE_WORDS}" = '' ]; then
    CONCERN_FOUND=true

    if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
        echo "${DUPLICATE_WORDS}" > build/log/duplicate-words.txt
    else
        echo
        echo "(WARNING) Duplicate words:"
        echo "${DUPLICATE_WORDS}"
    fi
fi

# shellcheck disable=SC2016
SHELLCHECK_IGNORES=$(${FIND} . -regextype posix-extended -type f ! -regex "${EXCLUDE_FILTER}" -exec sh -c 'grep -Hrn "# shellcheck" "${1}" | grep -v "${2}"' '_' '{}' '${0}' \;)

if [ ! "${SHELLCHECK_IGNORES}" = '' ]; then
    if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
        echo "${SHELLCHECK_IGNORES}" > build/log/shellcheck-ignores.txt
    else
        echo
        echo "(NOTICE) Shellcheck ignores:"
        echo
        echo "${SHELLCHECK_IGNORES}"
    fi
fi

RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    mkdir -p build/log/mess_detector
    vendor/bin/phpmd src,test html .phpmd.xml --reportfile build/log/mess_detector/index.html || RETURN_CODE="${?}"
else
    OUTPUT=$(vendor/bin/phpmd src,test text .phpmd.xml) || RETURN_CODE="${?}"
fi

# 0 means no mess detected.
if [ "${RETURN_CODE}" = 2 ]; then
    echo
    echo "(NOTICE) Mess detector violations found."
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

RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpstan analyse --configuration .phpstan.neon --no-progress --error-format checkstyle --level max src test web > build/log/checkstyle-phpstan.xml || RETURN_CODE="${?}"
    # TODO: What to do with this return code?
else
    OUTPUT=$(vendor/bin/phpstan analyse --configuration .phpstan.neon --no-progress --no-ansi --level max src test web) && FOUND=false || FOUND=true

    if [ "${FOUND}" = true ]; then
        echo
        echo "(NOTICE) PhpStan concerns found."
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
    echo "(NOTICE) Code sniffer concerns found."
    echo
fi

echo

RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phpcpd --log-pmd build/log/pmd-cpd.xml src test || RETURN_CODE="${?}"
    # TODO: What to do with this return code?
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

echo
RETURN_CODE=0

if [ ! "${PHPBREW_PHP}" = '' ]; then
    phpbrew ext disable xdebug
fi

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/phan --output-mode checkstyle | tee build/log/checkstyle-phan.xml || RETURN_CODE="${?}"
else
    vendor/bin/phan || RETURN_CODE="${?}"
fi

if [ ! "${PHPBREW_PHP}" = '' ]; then
    phpbrew ext enable xdebug
fi

if [ ! "${RETURN_CODE}" = 0 ]; then
    CONCERN_FOUND=true
    echo "Phan concerns found."
    echo
fi

echo
RETURN_CODE=0

if [ "${CONTINUOUS_INTEGRATION_MODE}" = true ]; then
    vendor/bin/psalm --no-progress --report=build/log/psalm.txt || RETURN_CODE="${?}"
else
    vendor/bin/psalm --no-progress || RETURN_CODE="${?}"
fi

if [ ! "${RETURN_CODE}" = 0 ]; then
    CONCERN_FOUND=true
    echo "Psalm concerns found."
    echo
fi

if [ "${CONCERN_FOUND}" = true ]; then
    if [ "${CONTINUOUS_INTEGRATION_MODE}" = false ]; then
        echo
        echo "Concern(s) of category WARNING found." >&2
    fi

    exit 2
fi
