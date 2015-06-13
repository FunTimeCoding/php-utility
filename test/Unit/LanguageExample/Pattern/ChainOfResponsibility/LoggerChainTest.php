<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\ChainOfResponsibility;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\AbstractLogger;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\LoggerChain;
use PHPUnit_Framework_TestCase;

class LoggerChainTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testChainOfLoggers()
    {
        $chain = new LoggerChain();
        $logger = $chain->createChain();

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
