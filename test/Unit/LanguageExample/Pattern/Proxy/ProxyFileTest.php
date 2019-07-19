<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Proxy;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Proxy\ProxyFile;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Proxy\RealFile;
use PHPUnit\Framework\TestCase;

class ProxyFileTest extends TestCase
{
    public function testNotYetLoaded(): void
    {
        $image = new ProxyFile('MyFilename');

        $this->assertEquals(new RealFile(''), $image->getFile());
    }

    public function testAfterLoading(): void
    {
        $image = new ProxyFile('MyFilename');

        $image->getContent();

        $this->assertEquals(new RealFile('MyFilename'), $image->getFile());
    }
}
