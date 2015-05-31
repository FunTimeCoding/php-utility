<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Observer;

class ConcreteObserver implements ObserverInterface
{
    public function update()
    {
        echo 'Update called.';
    }
}
