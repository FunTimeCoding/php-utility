#!/usr/bin/env php
<?php

namespace FunTimeCoding\PhpUtility\Bin;

use Exception;
use FunTimeCoding\PhpUtility\LanguageExample\RabbitMessageQueue\Producer;

require_once 'vendor/autoload.php';

$producer = new Producer();

try {
    $producer->main();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
