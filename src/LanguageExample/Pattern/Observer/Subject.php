<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Observer;

class Subject
{
    /**
     * @var ObserverInterface[]
     */
    private $observers = [];

    public function attach(ObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(ObserverInterface $observer): void
    {
        $key = array_search($observer, $this->observers, true);

        if (false !== $key) {
            unset($this->observers[$key]);
        }

        $this->observers = array_values($this->observers);
    }

    public function notifyObservers(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

    /**
     * @return ObserverInterface[]
     */
    public function getObservers(): array
    {
        return $this->observers;
    }
}
