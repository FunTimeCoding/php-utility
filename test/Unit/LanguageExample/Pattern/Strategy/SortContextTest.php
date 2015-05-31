<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Strategy;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Strategy\BubbleSortStrategy;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Strategy\QuickSortStrategy;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Strategy\SortContext;
use PHPUnit_Framework_TestCase;

class SortContextTest extends PHPUnit_Framework_TestCase
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
