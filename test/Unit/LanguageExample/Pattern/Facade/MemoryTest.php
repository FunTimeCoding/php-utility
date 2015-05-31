<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Facade\Memory;
use PHPUnit_Framework_TestCase;

class MemoryTest extends PHPUnit_Framework_TestCase
{
    public function testRead()
    {
        $memory = new Memory();

        $result = $memory->load();

        $this->assertEquals('MemoryContents', $result);
    }
}
