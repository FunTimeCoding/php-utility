<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Adapter;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\Socket;
use PHPUnit\Framework\TestCase;

class SocketTest extends TestCase
{
    public function testCanInstantiate(): void
    {
        $socket = new Socket();

        $result = $socket->driveFemale();

        $this::assertEquals('Socket driven.', $result);
    }
}
