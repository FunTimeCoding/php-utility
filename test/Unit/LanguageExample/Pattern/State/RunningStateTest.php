<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\State;

use Exception;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\EngineStateContext;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\StoppedState;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\RunningState;
use PHPUnit\Framework\TestCase;

class RunningStateTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testStart(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Cannot start a running engine.');
        $state = new RunningState();
        $context = new EngineStateContext();

        $state->start($context);
    }

    /**
     * @outputBuffering enabled
     */
    public function testStop(): void
    {
        $state = new RunningState();
        $context = new EngineStateContext();

        $state->stop($context);

        $this::assertEquals(new StoppedState(), $context->getState());
        $this->expectOutputString('Engine stopped.');
    }
}
