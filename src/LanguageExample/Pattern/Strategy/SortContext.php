<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Strategy;

class SortContext
{
    /**
     * @var SortStrategyInterface
     */
    private $strategy;

    /**
     * @param SortStrategyInterface $strategy
     */
    public function __construct(SortStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param SortStrategyInterface $strategy
     */
    public function setStrategy(SortStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param array $elements
     *
     * @return array
     */
    public function sort(array $elements)
    {
        return $this->strategy->sort($elements);
    }
}
