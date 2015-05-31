<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\State;

class EngineStateContext
{
    /**
     * @var EngineStateInterface
     */
    private $state;

    public function __construct()
    {
        $this->state = new StoppedState();
    }

    /**
     * @param EngineStateInterface $state
     */
    public function setState(EngineStateInterface $state)
    {
        $this->state = $state;
    }

    public function start()
    {
        $this->state->start($this);
    }

    public function stop()
    {
        $this->state->stop($this);
    }
}
