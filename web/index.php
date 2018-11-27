<?php
namespace FunTimeCoding\PhpUtility\Web;

use FunTimeCoding\PhpUtility\FrontEnd;

require __DIR__ . '/../vendor/autoload.php';

if (isset($_SERVER['REQUEST_URI']) && isset($_SERVER['REQUEST_METHOD'])) {
    FrontEnd::main($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
}
