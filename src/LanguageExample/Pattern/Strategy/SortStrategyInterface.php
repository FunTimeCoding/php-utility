<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy;

interface SortStrategyInterface
{
    /**
     * @param int[] $unsortedIntegers
     *
     * @return int[] sorted integers
     */
    public function sort(array $unsortedIntegers): array;
}
