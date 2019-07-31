<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy;

use FunTimeCoding\PhpUtility\Framework\FrameworkException;

class MergeSortStrategy implements SortStrategyInterface
{
    /**
     * @param int[] $elements
     *
     * @return int[]
     * @throws FrameworkException
     */
    public function sort(array $elements): array
    {
        return $this->mergeSort($elements);
    }

    /**
     * @param int[] $elements
     *
     * @return int[]
     * @throws FrameworkException
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
     * @throws FrameworkException
     */
    private function merge(array $left, array $right): array
    {
        $result = [];

        while (count($left) > 0 || count($right) > 0) {
            if (count($left) > 0 && count($right) > 0) {
                $firstLeft = current($left);
                $firstRight = current($right);

                if ($firstLeft <= $firstRight) {
                    $result[] = $this::arrayShift($left);
                } else {
                    $result[] = $this::arrayShift($right);
                }
            } elseif (count($left) > 0) {
                $result[] = $this::arrayShift($left);
            } elseif (count($right) > 0) {
                $result[] = $this::arrayShift($right);
            }
        }

        return $result;
    }

    /**
     * @param int[] $theArray
     * @return int
     * @throws FrameworkException
     */
    public static function arrayShift(array &$theArray): int
    {
        $element = array_shift($theArray);

        if (is_int($element) === false) {
            throw new FrameworkException('Array contained a non-integer.');
        }

        return $element;
    }
}
