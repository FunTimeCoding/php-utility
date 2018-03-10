<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Iterator;

use FunTimeCoding\PhpUtility\LanguageExample\Iterator\UserAgeFilterIteratorExample;
use PHPUnit\Framework\TestCase;

class UserAgeFilterIteratorExampleTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testFilterIterator()
    {
        $example = new UserAgeFilterIteratorExample();

        $example->filterIterator();

        $this->expectOutputString('Another 31' . PHP_EOL);
    }
}