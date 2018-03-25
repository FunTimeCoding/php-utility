<?php
namespace FunTimeCoding\PhpUtility\Web;

use FunTimeCoding\PhpUtility\FrontEnd;

require __DIR__ . '/../vendor/autoload.php';
FrontEnd::main($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
