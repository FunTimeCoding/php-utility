#!/bin/sh -e

ip addr show eth1 | grep --perl-regexp --only-matching 'inet \K[\d.]+'
