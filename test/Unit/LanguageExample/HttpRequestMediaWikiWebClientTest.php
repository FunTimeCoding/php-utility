<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample;

use FunTimeCoding\PhpSkeleton\LanguageExample\HttpRequestMediaWikiWebClient;
use PHPUnit_Framework_TestCase;

class HttpRequestMediaWikiWebClientTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $client = new HttpRequestMediaWikiWebClient('mediawiki.dev');

        $this->assertNotNull($client);
    }
}
