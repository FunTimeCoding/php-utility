<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Strategy;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy\QuickSortStrategy;
use PHPUnit_Framework_TestCase;

class QuickSortStrategyTest extends PHPUnit_Framework_TestCase
{
    public function testSort()
    {
        $strategy = new QuickSortStrategy();
        $elements = array(1, 5, 4, 2, 3);

        $result = $strategy->sort($elements);

        $this->assertEquals(array(1, 2, 3, 4, 5), $result);
    }
}
