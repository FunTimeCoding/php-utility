<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy;

class MergeSortStrategy implements SortStrategyInterface
{
    /**
     * @param int[] $elements
     *
     * @return int[]
     */
    public function sort(array $elements): array
    {
        return $this->mergeSort($elements);
    }

    /**
     * @param int[] $elements
     *
     * @return int[]
     */
    private function mergeSort(array $elements): array
    {
        if (1 === count($elements)) {
            return $elements;
        }

        $left = $right = [];
        $middle = (int)round(count($elements) / 2);

        for ($cursor = 0; $cursor < $middle; ++$cursor) {
            $left[] = $elements[$cursor];
        }

        for ($cursor = $middle; $cursor < count($elements); ++$cursor) {
            $right[] = $elements[$cursor];
        }

        $left = $this->mergeSort($left);
        $right = $this->mergeSort($right);

        return $this->merge($left, $right);
    }

    /**
     * @param int[] $left
     * @param int[] $right
     *
     * @return int[]
     */
    private function merge(array $left, array $right): array
    {
        $result = [];

        while (count($left) > 0 || count($right) > 0) {
            if (count($left) > 0 && count($right) > 0) {
                $firstLeft = current($left);
                $firstRight = current($right);

                if ($firstLeft <= $firstRight) {
                    $result[] = array_shift($left);
                } else {
                    $result[] = array_shift($right);
                }
            } elseif (count($left) > 0) {
                $result[] = array_shift($left);
            } elseif (count($right) > 0) {
                $result[] = array_shift($right);
            }
        }

        return $result;
    }
}
