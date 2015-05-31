<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Facade\Processor;
use PHPUnit_Framework_TestCase;

class ProcessorTest extends PHPUnit_Framework_TestCase
{
    public function testRead()
    {
        $processor = new Processor();

        $result = $processor->execute();

        $this->assertEquals('ProgramResult', $result);
    }
}
