#!/usr/bin/env php
<?php

if (count($argv) !== 2) {
    echo 'Usage: ' . $argv[0] . ' BYTE_COUNT' . PHP_EOL;

    exit(1);
}

try {
    echo bin2hex(random_bytes($argv[1])) . PHP_EOL;
} catch (Exception $e) {
    echo 'Could not generate random bytes.' . PHP_EOL;

    exit(1);
}
