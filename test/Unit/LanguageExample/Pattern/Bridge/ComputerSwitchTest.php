<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Bridge;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Bridge\ComputerSwitch;
use PHPUnit_Framework_TestCase;

class ComputerSwitchTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testOn()
    {
        $switch = new ComputerSwitch();

        $switch->turnOn();

        $this->expectOutputString('Computer on.');
    }

    /**
     * @outputBuffering enabled
     */
    public function testOff()
    {
        $switch = new ComputerSwitch();

        $switch->turnOff();

        $this->expectOutputString('Computer off.');
    }
}
