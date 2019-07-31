<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command;

class LightReceiver implements SwitchableInterface
{
    public function powerOn(): void
    {
        echo 'Light on.';
    }

    public function powerOff(): void
    {
        echo 'Light off.';
    }
}
