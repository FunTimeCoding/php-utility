<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\State;

use Exception;

class StoppedState implements EngineStateInterface
{
    /**
     * @param EngineStateContext $context
     */
    public function start(EngineStateContext $context)
    {
        $context->setState(new RunningState());
        echo 'Engine started.';
    }

    /**
     * @param EngineStateContext $context
     *
     * @throws Exception
     */
    public function stop(EngineStateContext $context)
    {
        throw new Exception('Cannot stop a stopped engine.');
    }
}
