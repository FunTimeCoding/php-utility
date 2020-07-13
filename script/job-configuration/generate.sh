#!/bin/sh -e

REMOTE=$(git config --get remote.origin.url)
jjm --locator "${REMOTE}" --build-command script/build.sh --junit build/junit.xml --checkstyle 'build/log/checkstyle-*.xml' --hypertext-report mess_detector --recipients funtimecoding@gmail.com >configuration/job.xml
