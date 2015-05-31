<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Facade\ComputerFacade;
use PHPUnit_Framework_TestCase;

class ComputerFacadeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testStart()
    {
        $facade = new ComputerFacade();

        $facade->start();

        $this->expectOutputString('DiskContentsMemoryContentsProgramResult');
    }
}
