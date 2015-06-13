<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\ChainOfResponsibility;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\AbstractLogger;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\StandardErrorLogger;
use PHPUnit_Framework_TestCase;

class StandardErrorLoggerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testMatchingMask()
    {
        $logger = new StandardErrorLogger(AbstractLogger::LEVEL_ERROR);

        $logger->message('test_error', AbstractLogger::LEVEL_ERROR);

        $this->expectOutputString('Writing to standard error file descriptor: test_error'.PHP_EOL);
    }

    /**
     * @outputBuffering enabled
     */
    public function testNonMatchingMask()
    {
        $logger = new StandardErrorLogger(AbstractLogger::LEVEL_ERROR);

        $logger->message('test_notice', AbstractLogger::LEVEL_NOTICE);

        $this->expectOutputString('');
    }
}
