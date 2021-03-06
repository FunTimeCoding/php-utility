<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Facade\Memory;
use PHPUnit\Framework\TestCase;

class MemoryTest extends TestCase
{
    public function testRead(): void
    {
        $memory = new Memory();

        $result = $memory->load();

        $this::assertEquals('MemoryContents', $result);
    }
}
