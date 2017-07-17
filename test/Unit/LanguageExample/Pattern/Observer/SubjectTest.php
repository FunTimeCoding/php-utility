<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Observer;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Observer\ConcreteObserver;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Observer\Subject;
use PHPUnit\Framework\TestCase;

class SubjectTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testAttachNotifyObserver()
    {
        $subject = new Subject();
        $observer = new ConcreteObserver();
        $subject->attach($observer);

        $subject->notifyObservers();

        $this->expectOutputString('Update called.');
    }

    /**
     * @outputBuffering enabled
     */
    public function testNotifyMultiple()
    {
        $subject = new Subject();
        $observer1 = new ConcreteObserver();
        $observer2 = new ConcreteObserver();
        $subject->attach($observer1);
        $subject->attach($observer2);

        $subject->notifyObservers();

        $this->expectOutputString('Update called.Update called.');
    }

    /**
     * @outputBuffering enabled
     */
    public function testDetachObserver()
    {
        $subject = new Subject();
        $observer1 = new ConcreteObserver();
        $observer2 = new ConcreteObserver();
        $subject->attach($observer1);
        $subject->attach($observer2);
        $subject->detach($observer1);

        $subject->notifyObservers();

        $this->expectOutputString('Update called.');
        $this->assertAttributeEquals(array($observer2), 'observers', $subject);
    }
}
