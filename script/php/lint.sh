#!/bin/sh -e

vendor/bin/parallel-lint --exclude vendor .
