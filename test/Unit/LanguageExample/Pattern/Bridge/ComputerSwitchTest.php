<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Bridge;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Bridge\ComputerSwitch;
use PHPUnit\Framework\TestCase;

class ComputerSwitchTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testOn(): void
    {
        $switch = new ComputerSwitch();

        $switch->turnOn();

        $this->expectOutputString('Computer on.');
    }

    /**
     * @outputBuffering enabled
     */
    public function testOff(): void
    {
        $switch = new ComputerSwitch();

        $switch->turnOff();

        $this->expectOutputString('Computer off.');
    }
}
