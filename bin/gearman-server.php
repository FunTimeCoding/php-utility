#!/usr/bin/env php
<?php

namespace FunTimeCoding\PhpUtility\Bin;

use FunTimeCoding\PhpUtility\LanguageExample\Gearman\Server;

require_once 'vendor/autoload.php';

$server = new Server();
$server->main();
