<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities;

abstract class AbstractLogger
{
    public const LEVEL_ERROR = 3;
    public const LEVEL_NOTICE = 5;
    public const LEVEL_DEBUG = 7;

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
     */
    public function __construct(int $logLevelMask)
    {
        $this->logLevelMask = $logLevelMask;
    }

    public function setNextLoggerInChain(AbstractLogger $logger): void
    {
        $this->nextLoggerInChain = $logger;
    }

    public function message(string $message, int $logLevel): void
    {
        if ($logLevel <= $this->logLevelMask) {
            $this->writeMessage($message);
        }

        if ($this->nextLoggerInChain !== null) {
            $this->nextLoggerInChain->message($message, $logLevel);
        }
    }

    abstract protected function writeMessage(string $message): void;
}
