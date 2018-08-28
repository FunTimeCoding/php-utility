#!/bin/sh -e

# Development mode mounts the project root so it can be edited and re-ran without rebuilding the image and recreating the container.

if [ "${1}" = --development ]; then
    DEVELOPMENT=true
else
    DEVELOPMENT=false
fi

docker ps --all | grep --quiet php-utility && FOUND=true || FOUND=false

if [ "${FOUND}" = false ]; then
    if [ "${DEVELOPMENT}" = true ]; then
        docker create --name php-utility --volume $(pwd):/php-utility funtimecoding/php-utility
    else
        docker create --name php-utility funtimecoding/php-utility
    fi

    # TODO: Specifying the entry point overrides CMD in Dockerfile. Is this useful, or should all sub commands go through one entry point script? I'm inclined to say one entry point script per project.
    #docker create --name php-utility --volume $(pwd):/php-utility --entrypoint /php-utility/bin/other.sh funtimecoding/php-utility
    #docker create --name php-utility funtimecoding/php-utility /php-utility/bin/other.sh
    # TODO: Run tests this way?
    #docker create --name php-utility funtimecoding/php-utility /php-utility/script/docker/test.sh
fi

docker start --attach php-utility
