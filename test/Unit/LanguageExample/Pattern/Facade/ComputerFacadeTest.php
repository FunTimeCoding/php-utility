<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Facade;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Facade\ComputerFacade;
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
