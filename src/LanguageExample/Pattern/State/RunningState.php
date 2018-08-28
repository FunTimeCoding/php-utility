<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\State;

use Exception;

class RunningState implements EngineStateInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param EngineStateContext $context
     *
     * @throws Exception
     */
    public function start(EngineStateContext $context)
    {
        throw new Exception('Cannot start a running engine.');
    }

    /**
     * @param EngineStateContext $context
     */
    public function stop(EngineStateContext $context)
    {
        $context->setState(new StoppedState());
        echo 'Engine stopped.';
    }
}
