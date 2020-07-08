<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\State;

use Exception;

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

    public function setState(EngineStateInterface $state): void
    {
        $this->state = $state;
    }

    public function getState(): EngineStateInterface
    {
        return $this->state;
    }

    public function start(): void
    {
        $this->state->start($this);
    }

    /**
     * @throws Exception
     */
    public function stop(): void
    {
        $this->state->stop($this);
    }
}
