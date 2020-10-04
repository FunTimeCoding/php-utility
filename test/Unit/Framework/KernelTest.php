<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\Framework;

use FunTimeCoding\PhpUtility\Framework\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    public function testNormalExitCode(): void
    {
        $kernel = new Kernel();

        $this::assertSame(0, $kernel->load());
    }
}
