<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Bridge;

class LightSwitch implements SwitchBridgeInterface
{
    public function turnOff(): void
    {
        echo 'Light off.';
    }

    public function turnOn(): void
    {
        echo 'Light on.';
    }
}
