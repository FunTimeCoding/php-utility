<?php

use FunTimeCoding\PhpUtility\Framework\Kernel;
use FunTimeCoding\PhpUtility\PhpUtility\PhpUtility;

require_once realpath(__DIR__).'/../vendor/autoload.php';
$kernel = new Kernel();
$kernel->load();

$application = new PhpUtility();
$application->main();
