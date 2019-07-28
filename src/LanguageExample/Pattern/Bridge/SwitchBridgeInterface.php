<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Bridge;

/**
 * Adapter makes things work after they're designed. Bridge makes them work before they are.
 * A bridge pattern should be pointed out in its class doc block.
 */
interface SwitchBridgeInterface
{
    public function turnOn(): void;

    public function turnOff(): void;
}
