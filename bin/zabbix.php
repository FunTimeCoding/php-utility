#!/usr/bin/env php
<?php

namespace FunTimeCoding\PhpUtility\Bin;

use Exception;
use FunTimeCoding\PhpUtility\LanguageExample\Zabbix\Client;

require_once 'vendor/autoload.php';

$client = new Client();

try {
    $client->main();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
