<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities;

class LoggerChain
{
    public function createChain(): StandardOutputLogger
    {
        $logger = new StandardOutputLogger(AbstractLogger::LEVEL_DEBUG);
        $emailLogger = new EmailLogger(AbstractLogger::LEVEL_NOTICE);
        $logger->setNextLoggerInChain($emailLogger);
        $standardErrorLogger = new StandardErrorLogger(AbstractLogger::LEVEL_ERROR);
        $emailLogger->setNextLoggerInChain($standardErrorLogger);

        return $logger;
    }
}
