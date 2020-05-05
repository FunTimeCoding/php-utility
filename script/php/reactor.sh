#!/bin/sh -e

vendor/bin/rector process src test benchmark bin web --dry-run
