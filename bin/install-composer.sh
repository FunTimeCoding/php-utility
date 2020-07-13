#!/bin/sh -e

DIRECTORY=$(dirname "${0}")
SCRIPT_DIRECTORY=$(
    cd "${DIRECTORY}" || exit 1
    pwd
)
TEMPORARY_DIRECTORY="${SCRIPT_DIRECTORY}/../tmp"
COMPOSER_SETUP="${TEMPORARY_DIRECTORY}/composer-setup.php"

if [ ! -d "${TEMPORARY_DIRECTORY}" ]; then
    echo "Create temporary directory."
    mkdir "${TEMPORARY_DIRECTORY}"
fi

if [ ! -f "${COMPOSER_SETUP}" ]; then
    echo "Download installer."
    wget --output-document "${COMPOSER_SETUP}" https://getcomposer.org/installer
fi

LOCAL_BIN_DIRECTORY="${HOME}/.local/bin"
COMPOSER="${LOCAL_BIN_DIRECTORY}/composer"

if [ -f "${COMPOSER}" ]; then
    echo "Composer already installed."
else
    echo "Install composer."
    php "${COMPOSER_SETUP}" --install-dir="${LOCAL_BIN_DIRECTORY}" --filename=composer
fi
