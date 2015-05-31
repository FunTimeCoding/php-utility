<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Proxy;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Proxy\RealFile;
use PHPUnit_Framework_TestCase;

class RealFileTest extends PHPUnit_Framework_TestCase
{
    public function testAfterLoading()
    {
        $image = new RealFile('MyFilename');

        $content = $image->getContent();

        $this->assertEquals('Imaginary content of MyFilename', $content);
    }
}
