<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Adapter\Socket;
use PHPUnit_Framework_TestCase;

class SocketTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $socket = new Socket();

        $result = $socket->driveFemale();

        $this->assertEquals('Socket driven.', $result);
    }
}
