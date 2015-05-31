<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\State;

/**
 * This could also be an abstract class instead of an interface. The state pattern would still be valid.
 */
interface EngineStateInterface
{
    /**
     * @param EngineStateContext $context
     */
    public function start(EngineStateContext $context);

    /**
     * @param EngineStateContext $context
     */
    public function stop(EngineStateContext $context);
}
