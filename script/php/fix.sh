#!/bin/sh -e

vendor/bin/phpcbf --standard=PSR12 bin src test web
