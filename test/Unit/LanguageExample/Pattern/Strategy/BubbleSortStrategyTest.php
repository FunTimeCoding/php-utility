<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Strategy;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Strategy\BubbleSortStrategy;
use PHPUnit_Framework_TestCase;

class BubbleSortStrategyTest extends PHPUnit_Framework_TestCase
{
    public function testSort()
    {
        $strategy = new BubbleSortStrategy();
        $elements = array(1, 5, 4, 2, 3);

        $result = $strategy->sort($elements);

        $this->assertEquals(array(1, 2, 3, 4, 5), $result);
    }
}
