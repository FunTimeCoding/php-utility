#!/bin/sh -e

if [ "${1}" = '--tcp' ]; then
    mysql --user=root --password=root --host localhost --port 3307 --protocol TCP php_skeleton
else
    docker exec -it php-skeleton_mysql-service_1 mysql --user=root --password=root php_skeleton
fi
