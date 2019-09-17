<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Integration;

use League\Csv\Reader;
use PHPUnit\Framework\TestCase;

class CommaSeparatedValueTest extends TestCase
{
    public function testUseLibrary(): void
    {
        $reader = Reader::createFromPath(__DIR__ . '/Fixture/example.csv');
        $reader->setHeaderOffset(0);
        $header = $reader->getHeader();
        $this::assertContains('first name', $header);
        $this::assertContains('last name', $header);
        $this::assertContains('email', $header);
        $this::assertCount(2, $reader->getRecords());
    }
}
