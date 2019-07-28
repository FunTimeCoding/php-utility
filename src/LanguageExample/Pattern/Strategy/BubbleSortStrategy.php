<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy;

class BubbleSortStrategy implements SortStrategyInterface
{
    /**
     * @param int[] $elements
     *
     * @return int[]
     */
    public function sort(array $elements): array
    {
        $size = count($elements);

        for ($outer = 0; $outer < $size; ++$outer) {
            for ($inner = 0; $inner < $size - 1 - $outer; ++$inner) {
                if ($elements[$inner + 1] < $elements[$inner]) {
                    $this->swap($elements, $inner, $inner + 1);
                }
            }
        }

        return $elements;
    }

    /**
     * @param int[] $elements
     * @param int $leftElement
     * @param int $rightElement
     */
    private function swap(array &$elements, $leftElement, $rightElement): void
    {
        $tempNumber = $elements[$leftElement];
        $elements[$leftElement] = $elements[$rightElement];
        $elements[$rightElement] = $tempNumber;
    }
}
