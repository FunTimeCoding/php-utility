<?php
namespace FunTimeCoding\PhpUtility\Test\Integration;

use FunTimeCoding\PhpUtility\FrontEnd;
use PHPUnit\Framework\TestCase;

class FrontEndTest extends TestCase
{
    public function testIndexHandler(): void
    {
        $application = new FrontEnd();
        $this::assertRegExp(
            '/Hello friend./',
            $application->run('/', FrontEnd::GET)
        );
    }

    public function testSettingsHandler(): void
    {
        $application = new FrontEnd();
        $this::assertRegExp(
            '/Settings/',
            $application->run('/settings', FrontEnd::GET)
        );
    }
}
