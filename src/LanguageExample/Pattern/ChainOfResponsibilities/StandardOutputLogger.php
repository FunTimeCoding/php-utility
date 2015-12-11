<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities;

class StandardOutputLogger extends AbstractLogger
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
        echo 'Writing to standard output file descriptor: '.$message.PHP_EOL;
    }
}
