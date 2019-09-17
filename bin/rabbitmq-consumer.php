#!/usr/bin/env php
<?php

namespace FunTimeCoding\PhpUtility\Bin;

use FunTimeCoding\PhpUtility\LanguageExample\RabbitMessageQueue\Consumer;

require_once 'vendor/autoload.php';

$consumer = new Consumer();

try {
    $consumer->main();
} catch (\ErrorException $e) {
    echo $e->getMessage() . PHP_EOL;
}
