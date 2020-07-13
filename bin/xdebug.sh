#!/bin/sh -e

export XDEBUG_CONFIG="remote_enable=1 remote_host=127.0.0.1 remote_port=9000 idekey=XDEBUG_PHPSTORM"
export PHP_IDE_CONFIG=serverName=localhost
php -dxdebug.remote_autostart=On "$@"
