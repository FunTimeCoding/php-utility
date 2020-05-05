#!/bin/sh -e

docker exec -it php-skeleton_mysql-service_1 mysql --user=root --password=root php_skeleton <tmp/php_skeleton.sql
