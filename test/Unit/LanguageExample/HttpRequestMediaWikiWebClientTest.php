<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\HttpRequestMediaWikiWebClient;
use PHPUnit\Framework\TestCase;

class HttpRequestMediaWikiWebClientTest extends TestCase
{
    public function testCanInstantiate(): void
    {
        $client = new HttpRequestMediaWikiWebClient('mediawiki.dev');

        $this::assertNotNull($client);
    }
}
