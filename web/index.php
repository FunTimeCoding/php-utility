<?php

namespace FunTimeCoding\PhpUtility\Web;

use FunTimeCoding\PhpUtility\PhpUtility\PhpUtility;

require_once realpath(__DIR__).'/../vendor/autoload.php';

$application = new PhpUtility();
$application->main();
