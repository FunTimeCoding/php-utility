#!/bin/sh -e

ADDRESS=$(vagrant ssh --command /vagrant/script/vagrant/show-address.sh)
open "http://${ADDRESS}"
