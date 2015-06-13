<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities;

class StandardErrorLogger extends AbstractLogger
{
    /**
     * @param int $logLevelMask
     */
    public function __construct($logLevelMask)
    {
        parent::__construct($logLevelMask);
    }

    /**
     * @var string $message
     */
    protected function writeMessage($message)
    {
        echo 'Writing to standard error file descriptor: ' . $message . PHP_EOL;
    }
}
