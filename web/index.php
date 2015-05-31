<?php

use FunTimeCoding\PhpSkeleton\Framework\Kernel;
use FunTimeCoding\PhpSkeleton\ExampleNamespace\ExampleApplication;

require_once realpath(__DIR__).'/../vendor/autoload.php';
$kernel = new Kernel();
$kernel->load();

$application = new ExampleApplication();
$application->main();
