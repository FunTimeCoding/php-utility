<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Observer;

class Subject
{
    /**
     * @var ObserverInterface[]
     */
    private $observers = array();

    /**
     * @param ObserverInterface $observer
     */
    public function attach(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * @param ObserverInterface $observer
     */
    public function detach(ObserverInterface $observer)
    {
        $key = array_search($observer, $this->observers, true);

        if (false !== $key) {
            unset($this->observers[$key]);
        }

        $this->observers = array_values($this->observers);
    }

    public function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}
