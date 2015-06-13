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
    public function testTraversableIterator()
    {
        $example = new IteratorExample();

        $example->traversableIterator();

        $expected = <<<OUTPUT
lowerDrawer books
upperDrawer clothes

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
