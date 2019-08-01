<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Adapter;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\MaleToFemaleAdapter;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\Socket;
use PHPUnit\Framework\TestCase;

class MaleToFemaleAdapterTest extends TestCase
{
    public function testDrive(): void
    {
        $adapter = new MaleToFemaleAdapter(new Socket());

        $result = $adapter->driveMale();

        $this::assertEquals('Socket driven.', $result);
    }
}
