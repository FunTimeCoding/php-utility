<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\MaleToFemaleAdapter;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter\Socket;
use PHPUnit_Framework_TestCase;

class MaleToFemaleAdapterTest extends PHPUnit_Framework_TestCase
{
    public function testDrive()
    {
        $adapter = new MaleToFemaleAdapter(new Socket());

        $result = $adapter->driveMale();

        $this->assertEquals('Socket driven.', $result);
    }
}
