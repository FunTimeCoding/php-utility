<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Integration\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\CurlMediaWikiWebClient;
use FunTimeCoding\PhpUtility\LanguageExample\HttpRequestMediaWikiWebClient;
use FunTimeCoding\PhpUtility\Framework\YamlConfiguration;
use FunTimeCoding\PhpUtility\LanguageExample\MediaWikiWebClient;
use PHPUnit\Framework\TestCase;

class MediaWikiWebClientTest extends TestCase
{
    public function testLoginWithHttpRequestLibrary(): void
    {
        $configuration = new YamlConfiguration('~/.php-utility.yaml');
        $locator = $configuration->get('mediawiki-server');
        $clients = [
            new HttpRequestMediaWikiWebClient($locator),
            new CurlMediaWikiWebClient($locator)
        ];

        foreach ($clients as $client) {
            /* @var MediaWikiWebClient $client */
            $client->setUsername($configuration->get('mediawiki-username'));
            $client->setPassword($configuration->get('mediawiki-password'));
            $client->login();
            $content = $client->getPage('Main_Page');
            $this::assertStringContainsString('MediaWiki has been installed', $content);
        }
    }
}
