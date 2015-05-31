<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use Exception;

class Calculator
{
    /**
     * @param int|float $augend
     * @param int|float $addend
     *
     * @return int|float sum
     */
    public function add($augend, $addend)
    {
        return $augend + $addend;
    }

    /**
     * @param int|float $dividend
     * @param int|float $divisor
     *
     * @return int|float quotient
     *
     * @throws Exception
     */
    public function div($dividend, $divisor)
    {
        if ($divisor == 0) {
            throw new Exception('Division by zero.');
        }

        return $dividend / $divisor;
    }
}
