<?php
namespace FunTimeCoding\PhpUtility\Test\Integration;

use League\Csv\Reader;
use PHPUnit\Framework\TestCase;

class CommaSeparatedValueTest extends TestCase
{
    /**
     * @throws \League\Csv\Exception
     */
    public function testUseLibrary()
    {
        $reader = Reader::createFromPath(__DIR__ . '/Fixture/example.csv', 'r');
        $reader->setHeaderOffset(0);
        $header = $reader->getHeader();
        $this->assertInternalType('array', $header);
        $this->assertContains('first name', $header);
        $this->assertContains('last name', $header);
        $this->assertContains('email', $header);
        $this->assertCount(2, $reader->getRecords());
    }
}
