#!/bin/sh -e

getopt -o w:hcv -l workspace:,help,clean,verbose --name "${0}" -- "$@" > /dev/null
CLEAN=0

while true; do
    case ${1} in
        -w|--workspace)
            WORKSPACE="${2-}"
            shift 2
            ;;
        -h|--help)
            echo "Usage: [-h][-c|--clean][-w|--workspace WORKSPACE]"
            exit 0
            ;;
        -c|--clean)
            CLEAN=1
            shift
            ;;
        -v|--verbose)
            set -x
            shift
            ;;
        --)
            shift
            break
            ;;
        *)
            if [ ! "${1}" = "" ]; then
                echo "Unknown option: ${1}"
            fi
            break
            ;;
    esac
done

if [ "${WORKSPACE}" = "" ]; then
    DIR=$(dirname "${0}")
    SCRIPT_DIR=$(cd "${DIR}"; pwd)
    WORKSPACE="${SCRIPT_DIR}"
fi

echo "WORKSPACE: ${WORKSPACE}"

if [ "${CLEAN}" = "1" ]; then
    "${WORKSPACE}/clear-cache.sh"
fi

COMPOSER_BIN="composer.phar"
COMPOSER_PATH="${WORKSPACE}/${COMPOSER_BIN}"

if [ ! -f "${COMPOSER_PATH}" ]; then
    curl -sS https://getcomposer.org/installer | php -- --install-dir="${WORKSPACE}" --filename="${COMPOSER_BIN}"
fi

"${COMPOSER_PATH}" selfupdate
"${COMPOSER_PATH}" install --no-interaction --no-progress
rm -rf "${WORKSPACE}/build"
"${WORKSPACE}/run-style-check.sh" --ci-mode
"${WORKSPACE}/run-metrics.sh" --ci-mode
"${WORKSPACE}/run-tests.sh" --ci-mode
