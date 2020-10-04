<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Integration\Framework;

use FunTimeCoding\PhpUtility\Framework\FrameworkException;
use FunTimeCoding\PhpUtility\Framework\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    /**
     * @throws FrameworkException
     */
    public function testGetProjectRoot(): void
    {
        $kernel = new Kernel();

        $projectRoot = $kernel->getProjectRoot();

        $this::assertNotEmpty($projectRoot);
    }

    /**
     * @throws FrameworkException
     */
    public function testCommandLineCallOfIndex(): void
    {
        $kernel = new Kernel();
        $projectRoot = $kernel->getProjectRoot();

        $command = 'php ' . $projectRoot . '/web/index.php';
        $output = [];
        $returnCode = -1;
        exec($command, $output, $returnCode);

        $this::assertEmpty($output);
        $this::assertSame(0, $returnCode);
    }
}
