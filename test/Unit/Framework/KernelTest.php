<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\Framework;

use FunTimeCoding\PhpSkeleton\Framework\Kernel;
use PHPUnit_Framework_TestCase;

class KernelTest extends PHPUnit_Framework_TestCase
{
    public function testNormalExitCode()
    {
        $kernel = new Kernel();

        $this->assertSame(0, $kernel->load());
    }
}
