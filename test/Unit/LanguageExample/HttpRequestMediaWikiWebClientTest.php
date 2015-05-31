<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\HttpRequestMediaWikiWebClient;
use PHPUnit_Framework_TestCase;

class HttpRequestMediaWikiWebClientTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $client = new HttpRequestMediaWikiWebClient('mediawiki.dev');

        $this->assertNotNull($client);
    }
}
