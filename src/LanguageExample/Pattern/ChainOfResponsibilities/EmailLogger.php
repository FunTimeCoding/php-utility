<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities;

class EmailLogger extends AbstractLogger
{
    protected function writeMessage(string $message): void
    {
        echo 'Sending by email: ' . $message . PHP_EOL;
    }
}
