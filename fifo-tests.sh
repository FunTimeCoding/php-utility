#!/bin/sh

if [ ! -p test-commands ]; then
    mkfifo test-commands
fi

while true; do
    COMMAND=$(cat test-commands)
    sh -c "${COMMAND}"
done
