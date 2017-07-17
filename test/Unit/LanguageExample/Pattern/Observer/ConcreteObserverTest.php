<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Observer;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Observer\ConcreteObserver;
use PHPUnit\Framework\TestCase;

class ConcreteObserverTest extends TestCase
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
