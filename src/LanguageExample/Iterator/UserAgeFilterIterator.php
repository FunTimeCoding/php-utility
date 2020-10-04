<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use FilterIterator;
use Iterator;

class UserAgeFilterIterator extends FilterIterator
{
    /**
     * @var int
     */
    private $minimum;

    /**
     * @var int
     */
    private $maximum;

    public function __construct(Iterator $iterator, int $minimum = -1, int $maximum = -1)
    {
        parent::__construct($iterator);
        $this->minimum = $minimum;
        $this->maximum = $maximum;
    }

    public function accept(): bool
    {
        /** @var User $current */
        $current = $this->getInnerIterator()->current();
        $age = $current->getAge();

        if ($this->minimum !== -1 && $age < $this->minimum) {
            return false;
        }

        if ($this->maximum !== -1 && $age > $this->maximum) {
            return false;
        }

        return true;
    }
}
