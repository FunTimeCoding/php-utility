<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Bridge;

/**
 * Adapter makes things work after they're designed. Bridge makes them work before they are.
 */
interface SwitchBridgeInterface
{
    public function turnOn();

    public function turnOff();
}
