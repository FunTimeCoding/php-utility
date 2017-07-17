<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\Framework;

use FunTimeCoding\PhpUtility\Framework\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    public function testNormalExitCode()
    {
        $kernel = new Kernel();

        $this->assertSame(0, $kernel->load());
    }
}
