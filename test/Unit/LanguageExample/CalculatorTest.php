<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample;

use Exception;
use FunTimeCoding\PhpSkeleton\LanguageExample\Calculator;
use PHPUnit_Framework_TestCase;

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    public function testAddPositiveNumbers()
    {
        $calc = new Calculator();

        $result = $calc->add(1, 2);

        $this->assertEquals(3, $result);
    }

    public function testAddNegativeNumbers()
    {
        $calc = new Calculator();

        $result = $calc->add(-1, -2);

        $this->assertEquals(-3, $result);
    }

    public function testDivideEqualNumbers()
    {
        $calc = new Calculator();

        $result = $calc->div(2, 2);

        $this->assertEquals(1, $result);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Division by zero.
     */
    public function testDivideByZero()
    {
        $calc = new Calculator();

        $calc->div(2, 0);
    }
}
