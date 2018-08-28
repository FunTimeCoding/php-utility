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
    public function testStartWhenEngineIsOff()
    {
        $context = new EngineStateContext();
        $context->start();

        $this->assertAttributeEquals(new RunningState(), 'state', $context);
        $this->expectOutputString('Engine started.');
    }

    /**
     * @outputBuffering enabled
     * @throws \Exception
     */
    public function testStopWhenEngineIsOn()
    {
        $context = new EngineStateContext();
        $context->start();

        $context->stop();

        $this->assertAttributeEquals(new StoppedState(), 'state', $context);
        $this->expectOutputString('Engine started.Engine stopped.');
    }

    public function testSetStateToRunning()
    {
        $context = new EngineStateContext();

        $context->setState(new RunningState());

        $this->assertAttributeEquals(new RunningState(), 'state', $context);
    }

    public function testSetStateToOff()
    {
        $context = new EngineStateContext();

        $context->setState(new StoppedState());

        $this->assertAttributeEquals(new StoppedState(), 'state', $context);
    }
}
