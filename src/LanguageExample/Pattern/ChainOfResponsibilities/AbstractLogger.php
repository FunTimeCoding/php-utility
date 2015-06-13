<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities;

abstract class AbstractLogger
{
    const LEVEL_ERROR = 3;
    const LEVEL_NOTICE = 5;
    const LEVEL_DEBUG = 7;

    /**
     * @var int
     */
    private $logLevelMask;

    /**
     * @var AbstractLogger
     */
    private $nextLoggerInChain;

    /**
     * This constructor has to be called from all child classes. This is problematic because it cannot be enforced.
     *
     * @param int $logLevelMask
     */
    public function __construct($logLevelMask)
    {
        $this->logLevelMask = $logLevelMask;
    }

    /**
     * @param AbstractLogger $logger
     */
    public function setNextLoggerInChain(AbstractLogger $logger)
    {
        $this->nextLoggerInChain = $logger;
    }

    /**
     * @param string $message
     * @param int $logLevel
     */
    public function message($message, $logLevel)
    {
        if ($logLevel <= $this->logLevelMask) {
            $this->writeMessage($message);
        }

        if ($this->nextLoggerInChain != null) {
            $this->nextLoggerInChain->message($message, $logLevel);
        }
    }

    /**
     * @var string $message
     */
    abstract protected function writeMessage($message);
}
