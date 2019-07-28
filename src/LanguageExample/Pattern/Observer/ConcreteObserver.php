<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Observer;

class ConcreteObserver implements ObserverInterface
{
    public function update(): void
    {
        echo 'Update called.';
    }
}
