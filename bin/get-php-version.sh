#!/bin/sh -e

LOCATOR="https://secure.php.net/releases/index.php?json&version=5"
OUTPUT=$(wget --quiet "${LOCATOR}" --output-document -)
VERSION=$(echo "${OUTPUT}" | jq --raw-output '.version')
echo "PHP 5: ${VERSION}"
LOCATOR="https://secure.php.net/releases/index.php?json&version=7"
OUTPUT=$(wget --quiet "${LOCATOR}" --output-document -)
VERSION=$(echo "${OUTPUT}" | jq --raw-output '.version')
echo "PHP 7: ${VERSION}"
