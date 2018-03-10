<?php

namespace FunTimeCoding\PhpUtility\Test\Integration\Framework;

use FunTimeCoding\PhpUtility\Framework\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    public function testGetProjectRoot()
    {
        $kernel = new Kernel();

        $projectRoot = $kernel->getProjectRoot();

        $this->assertNotEmpty($projectRoot);
    }

    public function testCommandLineCallOfIndex()
    {
        $kernel = new Kernel();
        $projectRoot = $kernel->getProjectRoot();

        $command = 'php '.$projectRoot.'/web/index.php';
        $output = [];
        $returnCode = -1;
        exec($command, $output, $returnCode);

        $this->assertNotEmpty($output, 'page should never be blank');
        $this->assertSame(0, $returnCode);
    }
}
