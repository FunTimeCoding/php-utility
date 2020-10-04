<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities;

class StandardOutputLogger extends AbstractLogger
{
    protected function writeMessage(string $message): void
    {
        echo 'Writing to standard output file descriptor: ' . $message . PHP_EOL;
    }
}
