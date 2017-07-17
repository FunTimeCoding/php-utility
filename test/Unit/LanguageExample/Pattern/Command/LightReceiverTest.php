<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\LightReceiver;
use PHPUnit\Framework\TestCase;

class LightReceiverTest extends TestCase
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
