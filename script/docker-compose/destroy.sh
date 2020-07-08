#!/bin/sh -e

docker-compose down || true
sudo rm -rf tmp/mysql_data
