<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\ChainOfResponsibility;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\AbstractLogger;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\EmailLogger;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\StandardErrorLogger;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\StandardOutputLogger;
use PHPUnit_Framework_TestCase;

class StandardOutputLoggerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testMatchingMask()
    {
        $logger = new StandardOutputLogger(AbstractLogger::LEVEL_ERROR);

        $logger->message('test_error', AbstractLogger::LEVEL_ERROR);

        $this->expectOutputString('Writing to standard output file descriptor: test_error' . PHP_EOL);
    }

    /**
     * @outputBuffering enabled
     */
    public function testNonMatchingMask()
    {
        $logger = new StandardOutputLogger(AbstractLogger::LEVEL_ERROR);

        $logger->message('test_notice', AbstractLogger::LEVEL_NOTICE);

        $this->expectOutputString('');
    }

    /**
     * @outputBuffering enabled
     */
    public function testChainOfLoggers()
    {
        $logger = new StandardOutputLogger(AbstractLogger::LEVEL_DEBUG);
        $emailLogger = new EmailLogger(AbstractLogger::LEVEL_NOTICE);
        $logger->setNextLoggerInChain($emailLogger);
        $standardErrorLogger = new StandardErrorLogger(AbstractLogger::LEVEL_ERROR);
        $emailLogger->setNextLoggerInChain($standardErrorLogger);

        $logger->message('test_debug', AbstractLogger::LEVEL_DEBUG);
        $logger->message('test_notice', AbstractLogger::LEVEL_NOTICE);
        $logger->message('test_error', AbstractLogger::LEVEL_ERROR);

        $expected = <<<OUTPUT
Writing to standard output file descriptor: test_debug
Writing to standard output file descriptor: test_notice
Sending by email: test_notice
Writing to standard output file descriptor: test_error
Sending by email: test_error
Writing to standard error file descriptor: test_error

OUTPUT;

        $this->expectOutputString($expected);
    }
}
