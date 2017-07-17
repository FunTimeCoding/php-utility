<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Facade\ComputerFacade;
use PHPUnit\Framework\TestCase;

class ComputerFacadeTest extends TestCase
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
