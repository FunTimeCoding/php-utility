<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Facade\Memory;
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
