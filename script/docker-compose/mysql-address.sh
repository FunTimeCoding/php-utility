#!/bin/sh -e

docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' php-skeleton_mysql-service_1
