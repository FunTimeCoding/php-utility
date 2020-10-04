<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy;

class SortContext
{
    /**
     * @var SortStrategyInterface
     */
    private $strategy;

    public function __construct(SortStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(SortStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * @param int[] $unsortedIntegers
     *
     * @return int[] sorted integers
     */
    public function sort(array $unsortedIntegers): array
    {
        return $this->strategy->sort($unsortedIntegers);
    }
}
