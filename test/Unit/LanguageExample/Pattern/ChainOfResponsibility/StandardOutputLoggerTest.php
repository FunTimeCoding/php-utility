<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\ChainOfResponsibility;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\AbstractLogger;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\ChainOfResponsibilities\StandardOutputLogger;
use PHPUnit\Framework\TestCase;

class StandardOutputLoggerTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testMatchingMask(): void
    {
        $logger = new StandardOutputLogger(AbstractLogger::LEVEL_ERROR);

        $logger->message('test_error', AbstractLogger::LEVEL_ERROR);

        $this->expectOutputString('Writing to standard output file descriptor: test_error'.PHP_EOL);
    }

    /**
     * @outputBuffering enabled
     */
    public function testNonMatchingMask(): void
    {
        $logger = new StandardOutputLogger(AbstractLogger::LEVEL_ERROR);

        $logger->message('test_notice', AbstractLogger::LEVEL_NOTICE);

        $this->expectOutputString('');
    }
}
