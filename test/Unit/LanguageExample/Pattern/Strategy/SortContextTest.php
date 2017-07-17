<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Strategy;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy\BubbleSortStrategy;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy\QuickSortStrategy;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy\SortContext;
use PHPUnit\Framework\TestCase;

class SortContextTest extends TestCase
{
    public function testSort()
    {
        $context = new SortContext(new BubbleSortStrategy());
        $context->setStrategy(new QuickSortStrategy());
        $elements = array(1, 5, 4, 2, 3);

        $result = $context->sort($elements);

        $this->assertEquals(array(1, 2, 3, 4, 5), $result);
    }
}
