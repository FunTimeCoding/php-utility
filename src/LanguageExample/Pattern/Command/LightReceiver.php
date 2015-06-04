<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command;

class LightReceiver implements SwitchableInterface
{
    public function powerOn()
    {
        echo 'Light on.';
    }

    public function powerOff()
    {
        echo 'Light off.';
    }
}
