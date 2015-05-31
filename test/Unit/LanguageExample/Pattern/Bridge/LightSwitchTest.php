<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Bridge;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Bridge\LightSwitch;
use PHPUnit_Framework_TestCase;

class LightSwitchTest extends PHPUnit_Framework_TestCase
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
