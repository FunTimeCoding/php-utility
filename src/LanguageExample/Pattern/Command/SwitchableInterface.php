<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command;

interface SwitchableInterface
{
    public function powerOn(): void;

    public function powerOff(): void;
}
