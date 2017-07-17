<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\Socket;
use PHPUnit\Framework\TestCase;

class SocketTest extends TestCase
{
    public function testCanInstantiate()
    {
        $socket = new Socket();

        $result = $socket->driveFemale();

        $this->assertEquals('Socket driven.', $result);
    }
}
