<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\CurlMediaWikiWebClient;
use PHPUnit_Framework_TestCase;

class CurlMediaWikiWebClientTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $client = new CurlMediaWikiWebClient('mediawiki.dev');

        $this->assertNotNull($client);
    }
}
