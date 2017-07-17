<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Observer;

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
    public function testStart()
    {
        $state = new StoppedState();
        $context = new EngineStateContext();

        $state->start($context);

        $this->assertAttributeEquals(new RunningState(), 'state', $context);
        $this->expectOutputString('Engine started.');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Cannot stop a stopped engine.
     */
    public function testStop()
    {
        $state = new StoppedState();
        $context = new EngineStateContext();

        $state->stop($context);
    }
}
