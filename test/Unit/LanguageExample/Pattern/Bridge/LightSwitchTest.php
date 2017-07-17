<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Bridge;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Bridge\LightSwitch;
use PHPUnit\Framework\TestCase;

class LightSwitchTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testOn()
    {
        $switch = new LightSwitch();

        $switch->turnOn();

        $this->expectOutputString('Light on.');
    }

    /**
     * @outputBuffering enabled
     */
    public function testOff()
    {
        $switch = new LightSwitch();

        $switch->turnOff();

        $this->expectOutputString('Light off.');
    }
}
