#!/bin/sh -e

docker exec -it php-skeleton_mysql-service_1 mysqldump --user=root --password=root --databases php_skeleton >tmp/php_skeleton.sql
