<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Observer;

use Exception;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\State\EngineStateContext;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\State\StoppedState;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\State\RunningState;
use PHPUnit_Framework_TestCase;

class RunningStateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Cannot start a running engine.
     */
    public function testStart()
    {
        $state = new RunningState();
        $context = new EngineStateContext();

        $state->start($context);
    }

    /**
     * @outputBuffering enabled
     */
    public function testStop()
    {
        $state = new RunningState();
        $context = new EngineStateContext();

        $state->stop($context);

        $this->assertAttributeEquals(new StoppedState(), 'state', $context);
        $this->expectOutputString('Engine stopped.');
    }
}
