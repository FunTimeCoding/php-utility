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

        $example->recursiveArrayIteratorWithForeach();

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

        $example->recursiveArrayIteratorWithWhile();

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

        $this->expectOutputString('Another 31' .PHP_EOL);
    }
}
