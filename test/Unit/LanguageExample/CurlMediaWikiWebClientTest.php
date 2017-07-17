<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\CurlMediaWikiWebClient;
use PHPUnit\Framework\TestCase;

class CurlMediaWikiWebClientTest extends TestCase
{
    public function testCanInstantiate()
    {
        $client = new CurlMediaWikiWebClient('mediawiki.dev');

        $this->assertNotNull($client);
    }
}
