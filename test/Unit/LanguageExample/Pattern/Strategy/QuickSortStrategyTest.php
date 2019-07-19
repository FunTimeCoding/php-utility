<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Strategy;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy\QuickSortStrategy;
use PHPUnit\Framework\TestCase;

class QuickSortStrategyTest extends TestCase
{
    public function testSort(): void
    {
        $strategy = new QuickSortStrategy();
        $elements = [1, 5, 4, 2, 3];

        $result = $strategy->sort($elements);

        $this->assertEquals([1, 2, 3, 4, 5], $result);
    }
}
