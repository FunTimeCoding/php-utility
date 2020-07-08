#!/bin/sh -e

docker cp schema.sql php-skeleton_mysql-service_1:/tmp/schema.sql
docker exec -it php-skeleton_mysql-service_1 sh -c 'mysql --user=root --password=root php_skeleton </tmp/schema.sql'
