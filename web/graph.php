<?php

namespace FunTimeCoding\PhpUtility\Web;

use FunTimeCoding\PhpUtility\GraphQueryLanguageService;

require __DIR__ . '/../vendor/autoload.php';

$service = new GraphQueryLanguageService();
$service->main();
