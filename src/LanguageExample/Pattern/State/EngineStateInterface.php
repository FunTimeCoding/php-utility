<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\State;

/**
 * This could also be an abstract class instead of an interface. The state pattern would still be valid.
 */
interface EngineStateInterface
{
    public function start(EngineStateContext $context): void;

    public function stop(EngineStateContext $context): void;
}
