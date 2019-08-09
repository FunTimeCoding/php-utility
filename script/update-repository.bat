@echo off
git pull
git submodule sync
git submodule update --init
git submodule foreach git checkout master
git submodule foreach git pull
