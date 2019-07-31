<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy;

class QuickSortStrategy implements SortStrategyInterface
{
    /**
     * @param int[] $elements
     *
     * @return int[]
     */
    public function sort(array $elements): array
    {
        $size = count($elements);

        return $this->quickSort($elements, 0, $size - 1);
    }

    /**
     * @param int[] $elements
     * @param int $left
     * @param int $right
     *
     * @return int[]
     */
    private function quickSort(array $elements, int $left, int $right): array
    {
        $leftTemp = $left;
        $rightTemp = $right;
        $separator = $elements[(int)floor(($left + $right) / 2)];

        while ($leftTemp <= $rightTemp) {
            while ($elements[$leftTemp] < $separator) {
                ++$leftTemp;
            }

            while ($elements[$rightTemp] > $separator) {
                --$rightTemp;
            }

            if ($leftTemp <= $rightTemp) {
                $tempNumber = $elements[$leftTemp];
                $elements[$leftTemp] = $elements[$rightTemp];
                $elements[$rightTemp] = $tempNumber;
                ++$leftTemp;
                --$rightTemp;
            }
        }

        if ($left < $rightTemp) {
            $elements = $this->quickSort($elements, $left, $rightTemp);
        }

        if ($right > $leftTemp) {
            $elements = $this->quickSort($elements, $leftTemp, $right);
        }

        return $elements;
    }
}
