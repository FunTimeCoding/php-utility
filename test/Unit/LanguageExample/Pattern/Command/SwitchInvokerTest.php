<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\CloseSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\LightReceiver;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\OpenSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchInvoker;
use PHPUnit\Framework\TestCase;

class SwitchInvokerTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testOn(): void
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
    public function testOff(): void
    {
        $light = new LightReceiver();
        $closedCommand = new CloseSwitchCommand($light);
        $openCommand = new OpenSwitchCommand($light);
        $switch = new SwitchInvoker($closedCommand, $openCommand);

        $switch->open();

        $this->expectOutputString('Light off.');
    }
}
