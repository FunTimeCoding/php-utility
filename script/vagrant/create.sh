#!/bin/sh -e

mkdir -p tmp

if [ ! -f tmp/ethernet-device.txt ]; then
    echo eth0 > tmp/ethernet-device.txt
fi

vagrant up
