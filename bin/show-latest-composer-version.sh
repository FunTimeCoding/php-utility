#!/bin/sh -e

VENDOR=composer
PROJECT=composer
curl --silent "https://api.github.com/repos/${VENDOR}/${PROJECT}/releases" | jq --raw-output '.[].tag_name' | grep --only-matching '^[0-9]\.[0-9]\.[0-9]$' | head -1
