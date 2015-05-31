<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Observer;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Observer\ConcreteObserver;
use PHPUnit_Framework_TestCase;

class ConcreteObserverTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testUpdate()
    {
        $observer = new ConcreteObserver();

        $observer->update();

        $this->expectOutputString('Update called.');
    }
}
