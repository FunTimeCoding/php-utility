<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\Ratchet;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\Socket;
use PHPUnit_Framework_TestCase;

class RatchetTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $ratchet = new Ratchet();

        $result = $ratchet->driveMale(new Socket());

        $this->assertEquals('Socket driven.', $result);
    }
}
