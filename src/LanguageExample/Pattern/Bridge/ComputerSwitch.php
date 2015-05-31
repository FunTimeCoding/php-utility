<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Bridge;

class ComputerSwitch implements SwitchBridgeInterface
{
    public function turnOff()
    {
        echo 'Computer off.';
    }

    public function turnOn()
    {
        echo 'Computer on.';
    }
}
