<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\State;

use Exception;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\EngineStateContext;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\StoppedState;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\RunningState;
use PHPUnit\Framework\TestCase;

class StoppedStateTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testStart(): void
    {
        $state = new StoppedState();
        $context = new EngineStateContext();

        $state->start($context);

        $this->assertEquals(new RunningState(), $context->getState());
        $this->expectOutputString('Engine started.');
    }

    /**
     * @throws Exception
     */
    public function testStop(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Cannot stop a stopped engine.');
        $state = new StoppedState();
        $context = new EngineStateContext();

        $state->stop($context);
    }
}
