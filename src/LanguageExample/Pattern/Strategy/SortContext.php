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

    public function sort(array $elements): array
    {
        return $this->strategy->sort($elements);
    }
}
