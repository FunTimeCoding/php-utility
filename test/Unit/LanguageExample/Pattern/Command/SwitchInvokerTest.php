<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\CloseSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\LightReceiver;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\OpenSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchInvoker;
use PHPUnit_Framework_TestCase;

class SwitchInvokerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testOn()
    {
        $light = new LightReceiver();
        $closedCommand = new CloseSwitchCommand($light);
        $openCommand = new OpenSwitchCommand($light);
        $switch = new SwitchInvoker($closedCommand, $openCommand);

        $switch->close();

        $this->expectOutputString('Light on.');
    }

    /**
     * @outputBuffering enabled
     */
    public function testOff()
    {
        $light = new LightReceiver();
        $closedCommand = new CloseSwitchCommand($light);
        $openCommand = new OpenSwitchCommand($light);
        $switch = new SwitchInvoker($closedCommand, $openCommand);

        $switch->open();

        $this->expectOutputString('Light off.');
    }
}
