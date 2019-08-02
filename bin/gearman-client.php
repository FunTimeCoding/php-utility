#!/usr/bin/env php
<?php

namespace FunTimeCoding\PhpUtility\Bin;

use FunTimeCoding\PhpUtility\LanguageExample\Gearman\Client;

require_once 'vendor/autoload.php';

$client = new Client();
$client->main();
