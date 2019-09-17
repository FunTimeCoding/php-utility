#!/bin/sh -e

COMMAND="${1}"

if [ "${COMMAND}" = '' ]; then
    #echo "Usage: ${0} COMMAND"
    #
    #exit 1
    COMMAND='/vagrant/bin/sleep.php'
fi

cd /home/vagrant/tmp/phpspy
./phpspy ${COMMAND} >/tmp/output
./stackcollapse-phpspy.pl </tmp/output | ./vendor/flamegraph.pl >/vagrant/tmp/flame.svg
rm phpspy.*.err phpspy.*.out
