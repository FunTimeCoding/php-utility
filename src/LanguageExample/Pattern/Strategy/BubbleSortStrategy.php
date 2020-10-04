<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy;

class BubbleSortStrategy implements SortStrategyInterface
{
    /**
     * @param int[] $unsortedIntegers
     *
     * @return int[]
     */
    public function sort(array $unsortedIntegers): array
    {
        $size = count($unsortedIntegers);

        for ($outer = 0; $outer < $size; ++$outer) {
            for ($inner = 0; $inner < $size - 1 - $outer; ++$inner) {
                if ($unsortedIntegers[$inner + 1] < $unsortedIntegers[$inner]) {
                    $this->swap($unsortedIntegers, $inner, $inner + 1);
                }
            }
        }

        return $unsortedIntegers;
    }

    /**
     * @param int[] $elements
     */
    private function swap(array &$elements, int $leftElement, int $rightElement): void
    {
        $tempNumber = $elements[$leftElement];
        $elements[$leftElement] = $elements[$rightElement];
        $elements[$rightElement] = $tempNumber;
    }
}
