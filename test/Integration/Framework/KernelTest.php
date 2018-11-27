<?php

namespace FunTimeCoding\PhpUtility\Test\Integration\Framework;

use FunTimeCoding\PhpUtility\Framework\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGetProjectRoot()
    {
        $kernel = new Kernel();

        $projectRoot = $kernel->getProjectRoot();

        $this->assertNotEmpty($projectRoot);
    }

    /**
     * @throws \Exception
     */
    public function testCommandLineCallOfIndex()
    {
        $kernel = new Kernel();
        $projectRoot = $kernel->getProjectRoot();

        $command = 'php ' . $projectRoot . '/web/index.php';
        $output = [];
        $returnCode = -1;
        exec($command, $output, $returnCode);

        $this->assertEmpty($output);
        $this->assertSame(0, $returnCode);
    }
}
