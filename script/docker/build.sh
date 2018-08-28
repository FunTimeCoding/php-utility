#!/bin/sh -e

docker images | grep --quiet funtimecoding/php-utility && FOUND=true || FOUND=false

if [ "${FOUND}" = true ]; then
    docker rmi funtimecoding/php-utility
fi

docker build --tag funtimecoding/php-utility .
