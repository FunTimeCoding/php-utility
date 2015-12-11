<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Iterator;

use FunTimeCoding\PhpUtility\LanguageExample\Iterator\IteratorExample;
use PHPUnit_Framework_TestCase;

class IteratorExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testArrayIterator()
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
    public function testRecursiveArrayIteratorWithForeach()
    {
        $example = new IteratorExample();

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
    public function testRecursiveArrayIteratorWithWhile()
    {
        $example = new IteratorExample();

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
    public function testIterator()
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
    public function testFilterIterator()
    {
        $example = new IteratorExample();

        $example->filterIterator();

        $this->expectOutputString('Another 31'.PHP_EOL);
    }

    /**
     * @outputBuffering enabled
     */
    public function testCallbackFilterIterator()
    {
        $this->markTestSkipped('CallbackFilterIterator requires php 5.6');

        $example = new IteratorExample();

        $example->callbackFilterIterator();

        $expected = <<<OUTPUT
0 apple

OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testRecursiveCallbackFilterIterator()
    {
        $this->markTestSkipped('RecursiveCallbackFilterIterator requires php 5.6');

        $example = new IteratorExample();

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
    public function testCachingIterator()
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
    public function testLimitInfiniteIterator()
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
    public function testRecursiveTreeIterator()
    {
        $example = new IteratorExample();

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

    /**
     * @outputBuffering enabled
     */
    public function testMultipleIterator()
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
    public function testAppendIterator()
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
    public function testRegexIterator()
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
    public function testIteratorApply()
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

    public function testIteratorToArray()
    {
        $example = new IteratorExample();

        $result = $example->iteratorToArray();

        $expected = array(
            'apple',
            'banana',
            'strawberry',
        );
        $this->assertequals($expected, $result);
    }

    public function testIteratorCount()
    {
        $example = new IteratorExample();

        $result = $example->iteratorCount();

        $this->assertequals(3, $result);
    }
}
