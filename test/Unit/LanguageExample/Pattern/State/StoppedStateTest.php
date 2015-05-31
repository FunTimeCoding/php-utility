<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Observer;

use Exception;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\State\EngineStateContext;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\State\StoppedState;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\State\RunningState;
use PHPUnit_Framework_TestCase;

class StoppedStateTest extends PHPUnit_Framework_TestCase
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
