<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\PhpUtility;

use FunTimeCoding\PhpUtility\PhpUtility\PhpUtility;
use PHPUnit_Framework_TestCase;

class PhpUtilityTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testMainMethod()
    {
        $app = new PhpUtility();

        $this->assertSame(0, $app->main());

        $this->expectOutputString('hello world'.PHP_EOL);
    }
}
