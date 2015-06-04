<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\LightReceiver;
use PHPUnit_Framework_TestCase;

class LightReceiverTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testOn()
    {
        $light = new LightReceiver();

        $light->powerOn();

        $this->expectOutputString('Light on.');
    }

    /**
     * @outputBuffering enabled
     */
    public function testOff()
    {
        $light = new LightReceiver();

        $light->powerOff();

        $this->expectOutputString('Light off.');
    }
}
