<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Integration\LanguageExample;

use FunTimeCoding\PhpUtility\Framework\FrameworkException;
use FunTimeCoding\PhpUtility\LanguageExample\CurlMediaWikiWebClient;
use FunTimeCoding\PhpUtility\LanguageExample\HttpRequestMediaWikiWebClient;
use FunTimeCoding\PhpUtility\Framework\YamlConfiguration;
use FunTimeCoding\PhpUtility\LanguageExample\MediaWikiWebClient;
use PHPUnit\Framework\TestCase;

class MediaWikiWebClientTest extends TestCase
{
    /**
     * @throws FrameworkException
     */
    public function testLoginWithHttpRequestLibrary(): void
    {
        $configuration = new YamlConfiguration('~/.php-utility.yaml');
        $locator = $configuration->get('wiki-locator');
        $clients = [
            new HttpRequestMediaWikiWebClient($locator),
            new CurlMediaWikiWebClient($locator)
        ];

        foreach ($clients as $client) {
            /* @var MediaWikiWebClient $client */
            $client->setUsername($configuration->get('wpName'));
            $client->setPassword($configuration->get('wpPassword'));
            $client->login();
            $content = $client->getPage('Main_Page');
            $this::assertStringContainsString('MediaWiki has been installed', $content);
        }
    }
}
