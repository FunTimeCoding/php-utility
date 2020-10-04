#!/bin/sh -e

DIRECTORY=$(dirname "${0}")
SCRIPT_DIRECTORY=$(
    cd "${DIRECTORY}" || exit 1
    pwd
)
# shellcheck source=/dev/null
. "${SCRIPT_DIRECTORY}/../../configuration/project.sh"

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
    TEE='gtee'
else
    TEE='tee'
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
    vendor/bin/phpstan analyse --configuration .phpstan.neon --no-progress --memory-limit 1G --error-format checkstyle --level max src test web >build/log/checkstyle-phpstan.xml || RETURN_CODE="${?}"
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
    vendor/bin/phpcs --standard=PSR12 --report=checkstyle --report-file=build/log/checkstyle-result.xml src test || RETURN_CODE="${?}"
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
