<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Adapter;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\Ratchet;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\Socket;
use PHPUnit\Framework\TestCase;

class RatchetTest extends TestCase
{
    public function testCanInstantiate(): void
    {
        $ratchet = new Ratchet();

        $result = $ratchet->driveMale(new Socket());

        $this->assertEquals('Socket driven.', $result);
    }
}
