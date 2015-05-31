<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Bridge;

class LightSwitch implements SwitchBridgeInterface
{
    public function turnOff()
    {
        echo 'Light off.';
    }

    public function turnOn()
    {
        echo 'Light on.';
    }
}
