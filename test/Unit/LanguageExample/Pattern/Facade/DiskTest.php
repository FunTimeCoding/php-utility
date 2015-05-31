<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Facade\Disk;
use PHPUnit_Framework_TestCase;

class DiskTest extends PHPUnit_Framework_TestCase
{
    public function testRead()
    {
        $disk = new Disk();

        $result = $disk->read();

        $this->assertEquals('DiskContents', $result);
    }
}
