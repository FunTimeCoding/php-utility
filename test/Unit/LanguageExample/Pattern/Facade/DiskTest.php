<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Facade\Disk;
use PHPUnit\Framework\TestCase;

class DiskTest extends TestCase
{
    public function testRead(): void
    {
        $disk = new Disk();

        $result = $disk->read();

        $this::assertEquals('DiskContents', $result);
    }
}
