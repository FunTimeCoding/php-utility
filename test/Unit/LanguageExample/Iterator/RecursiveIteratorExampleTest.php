<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Iterator;

use FunTimeCoding\PhpUtility\LanguageExample\Iterator\RecursiveIteratorExample;
use PHPUnit\Framework\TestCase;

class RecursiveIteratorExampleTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testRecursiveArrayIteratorWithForeach(): void
    {
        $example = new RecursiveIteratorExample();

        $example->recursiveArrayIterator();

        $expected = <<<OUTPUT
0 apple
1 banana
2 strawberry
0 blueberry
1 plum
2 orange

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testRecursiveArrayIteratorWithWhile(): void
    {
        $example = new RecursiveIteratorExample();

        $example->recursiveArrayIteratorWithWhileLoop();

        $expected = <<<OUTPUT
0 apple
1 banana
2 strawberry
0 blueberry
1 plum
2 orange

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testRecursiveCallbackFilterIterator(): void
    {
        $this::markTestSkipped('RecursiveCallbackFilterIterator requires php 5.6');
        // @phpstan-ignore-next-line
        $example = new RecursiveIteratorExample();

        $example->recursiveCallbackFilterIterator();

        $expected = <<<OUTPUT
0 apple
0 apple

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testRecursiveTreeIterator(): void
    {
        $example = new RecursiveIteratorExample();

        $example->recursiveTreeIterator();

        $expected = <<<OUTPUT
0 |-Array
0 | |-a
1 | \-Array
0 |   |-b
1 |   \-c
1 \-Array
0   |-d
1   \-e

OUTPUT;
        $this->expectOutputString($expected);
    }
}
