<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Proxy;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Proxy\ProxyFile;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Proxy\RealFile;
use PHPUnit_Framework_TestCase;

class ProxyFileTest extends PHPUnit_Framework_TestCase
{
    public function testNotYetLoaded()
    {
        $image = new ProxyFile('MyFilename');

        $this->assertAttributeEquals(null, 'file', $image);
    }

    public function testAfterLoading()
    {
        $image = new ProxyFile('MyFilename');

        $image->getContent();

        $this->assertAttributeEquals(new RealFile('MyFilename'), 'file', $image);
    }
}
