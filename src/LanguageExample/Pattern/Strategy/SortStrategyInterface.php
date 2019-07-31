<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy;

interface SortStrategyInterface
{
    /**
     * @param int[] $elements unsorted integers
     *
     * @return int[] sorted integers
     */
    public function sort(array $elements): array;
}
