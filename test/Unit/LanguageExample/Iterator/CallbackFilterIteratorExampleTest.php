<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Iterator;

use FunTimeCoding\PhpUtility\LanguageExample\Iterator\CallbackFilterIteratorExample;
use PHPUnit\Framework\TestCase;

class CallbackFilterIteratorExampleTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testCallbackFilterIterator(): void
    {
        $this::markTestSkipped('CallbackFilterIterator requires php 5.6');

        $example = new CallbackFilterIteratorExample();

        $example->callbackFilterIterator();

        $expected = <<<OUTPUT
0 apple

OUTPUT;
        $this->expectOutputString($expected);
    }
}
