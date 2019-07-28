<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Bridge;

class ComputerSwitch implements SwitchBridgeInterface
{
    public function turnOff(): void
    {
        echo 'Computer off.';
    }

    public function turnOn(): void
    {
        echo 'Computer on.';
    }
}
