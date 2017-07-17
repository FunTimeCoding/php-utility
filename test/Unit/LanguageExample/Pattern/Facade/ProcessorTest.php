<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Facade\Processor;
use PHPUnit\Framework\TestCase;

class ProcessorTest extends TestCase
{
    public function testRead()
    {
        $processor = new Processor();

        $result = $processor->execute();

        $this->assertEquals('ProgramResult', $result);
    }
}
