<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Proxy;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Proxy\RealFile;
use PHPUnit\Framework\TestCase;

class RealFileTest extends TestCase
{
    public function testAfterLoading()
    {
        $image = new RealFile('MyFilename');

        $content = $image->getContent();

        $this->assertEquals('Imaginary content of MyFilename', $content);
    }
}
