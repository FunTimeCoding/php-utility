<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities;

class EmailLogger extends AbstractLogger
{
    /**
     * @param int $logLevelMask
     */
    public function __construct($logLevelMask)
    {
        parent::__construct($logLevelMask);
    }

    /**
     * @var string
     */
    protected function writeMessage($message)
    {
        echo 'Sending by email: '.$message.PHP_EOL;
    }
}
