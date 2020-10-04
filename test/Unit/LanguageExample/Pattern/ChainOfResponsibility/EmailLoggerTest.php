<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\ChainOfResponsibility;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\AbstractLogger;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\EmailLogger;
use PHPUnit\Framework\TestCase;

class EmailLoggerTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testMatchingMask(): void
    {
        $logger = new EmailLogger(AbstractLogger::LEVEL_ERROR);

        $logger->message('test_error', AbstractLogger::LEVEL_ERROR);

        $this->expectOutputString('Sending by email: test_error' . PHP_EOL);
    }

    /**
     * @outputBuffering enabled
     */
    public function testNonMatchingMask(): void
    {
        $logger = new EmailLogger(AbstractLogger::LEVEL_ERROR);

        $logger->message('test_notice', AbstractLogger::LEVEL_NOTICE);

        $this->expectOutputString('');
    }
}
