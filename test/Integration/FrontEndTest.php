<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Integration;

use FunTimeCoding\PhpUtility\FrontEnd;
use PHPUnit\Framework\TestCase;

class FrontEndTest extends TestCase
{
    public function testIndexHandler(): void
    {
        $application = new FrontEnd();
        $this::assertMatchesRegularExpression(
            '/Hello friend./',
            $application->run('/', FrontEnd::GET)
        );
    }

    public function testSettingsHandler(): void
    {
        $application = new FrontEnd();
        $this::assertMatchesRegularExpression(
            '/Settings/',
            $application->run('/settings', FrontEnd::GET)
        );
    }
}
