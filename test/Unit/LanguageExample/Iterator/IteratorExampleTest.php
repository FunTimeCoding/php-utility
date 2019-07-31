<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Iterator;

use FunTimeCoding\PhpUtility\LanguageExample\Iterator\IteratorExample;
use PHPUnit\Framework\TestCase;

class IteratorExampleTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testArrayIterator(): void
    {
        $example = new IteratorExample();

        $example->arrayIterator();

        $expected = <<<OUTPUT
0 apple
1 banana
2 strawberry

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testIterator(): void
    {
        $example = new IteratorExample();

        $example->iterator();

        $expected = <<<OUTPUT
upperDrawer clothes
lowerDrawer books

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testCachingIterator(): void
    {
        $example = new IteratorExample();

        $example->cachingIterator();

        $expected = <<<OUTPUT
0 apple
1 banana
2 strawberry

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testLimitInfiniteIterator(): void
    {
        $example = new IteratorExample();

        $example->limitInfiniteIterator();

        $expected = <<<OUTPUT
0 apple
1 banana
2 strawberry
0 apple
1 banana
2 strawberry

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testMultipleIterator(): void
    {
        $example = new IteratorExample();

        $example->multipleIterator();

        $expected = <<<OUTPUT
apple bird
banana dog
strawberry horse

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testAppendIterator(): void
    {
        $example = new IteratorExample();

        $example->appendIterator();

        $expected = <<<OUTPUT
0 apple
1 banana
2 strawberry
0 bird
1 dog
2 horse

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testRegexIterator(): void
    {
        $example = new IteratorExample();

        $example->regexIterator();

        $expected = <<<OUTPUT
1 banana

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testIteratorApply(): void
    {
        $example = new IteratorExample();

        $example->iteratorApply();

        $expected = <<<OUTPUT
Picking: apple
Picking: banana
Picking: strawberry

OUTPUT;
        $this->expectOutputString($expected);
    }

    public function testIteratorToArray(): void
    {
        $example = new IteratorExample();

        $result = $example->iteratorToArray();

        $expected = [
            'apple',
            'banana',
            'strawberry',
        ];
        $this::assertEquals($expected, $result);
    }

    public function testIteratorCount(): void
    {
        $example = new IteratorExample();

        $result = $example->iteratorCount();

        $this::assertEquals(3, $result);
    }
}
