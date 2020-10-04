<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Strategy;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Strategy\BubbleSortStrategy;
use PHPUnit\Framework\TestCase;

class BubbleSortStrategyTest extends TestCase
{
    public function testSort(): void
    {
        $strategy = new BubbleSortStrategy();
        $elements = [1, 5, 4, 2, 3];

        $result = $strategy->sort($elements);

        $this::assertEquals([1, 2, 3, 4, 5], $result);
    }
}
