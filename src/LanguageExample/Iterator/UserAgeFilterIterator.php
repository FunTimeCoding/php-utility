<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use FilterIterator;
use Iterator;

class UserAgeFilterIterator extends FilterIterator
{
    private $minimum;
    private $maximum;

    /**
     * @param Iterator $iterator
     * @param int $minimum
     * @param int $maximum
     */
    public function __construct(Iterator $iterator, $minimum = -1, $maximum = -1)
    {
        parent::__construct($iterator);
        $this->minimum = $minimum;
        $this->maximum = $maximum;
    }

    /**
     * @return bool
     */
    public function accept()
    {
        /** @var User $current */
        $current = $this->getInnerIterator()->current();
        echo 'Iterating: ' . $current->getName() . PHP_EOL;
        $result = true;
        $age = $current->getAge();

        if ($this->minimum != -1 && $age < $this->minimum) {
            $result = false;
        } else if ($this->maximum != -1 && $age > $this->maximum) {
            $result = false;
        }

        return true;
        return $result;
    }
}
