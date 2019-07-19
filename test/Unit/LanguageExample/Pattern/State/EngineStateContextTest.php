<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\State;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\EngineStateContext;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\StoppedState;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\State\RunningState;
use PHPUnit\Framework\TestCase;

class EngineStateContextTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testStartWhenEngineIsOff(): void
    {
        $context = new EngineStateContext();
        $context->start();

        $this->assertEquals(new RunningState(), $context->getState());
        $this->expectOutputString('Engine started.');
    }

    /**
     * @outputBuffering enabled
     * @throws \Exception
     */
    public function testStopWhenEngineIsOn(): void
    {
        $context = new EngineStateContext();
        $context->start();

        $context->stop();

        $this->assertEquals(new StoppedState(), $context->getState());
        $this->expectOutputString('Engine started.Engine stopped.');
    }

    public function testSetStateToRunning(): void
    {
        $context = new EngineStateContext();

        $context->setState(new RunningState());

        $this->assertEquals(new RunningState(), $context->getState());
    }

    public function testSetStateToOff(): void
    {
        $context = new EngineStateContext();

        $context->setState(new StoppedState());

        $this->assertEquals(new StoppedState(), $context->getState());
    }
}
