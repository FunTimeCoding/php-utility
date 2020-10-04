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
     * @return array<array<MediaWikiWebClient>>
     * @throws FrameworkException
     */
    public function dataProviderTestLoginWithHttpRequestLibrary(): array
    {
        $configuration = new YamlConfiguration('~/.php-utility.yaml');
        $locator = $configuration->getString('mediawiki-server');

        return [
            [new HttpRequestMediaWikiWebClient($locator)],
            [new CurlMediaWikiWebClient($locator)]
        ];
    }

    /**
     * @dataProvider dataProviderTestLoginWithHttpRequestLibrary
     * @throws FrameworkException
     */
    public function testLoginWithHttpRequestLibrary(MediaWikiWebClient $client): void
    {
        $this::markTestSkipped('For some reason this cannot be excluded from Infection.');
        // @phpstan-ignore-next-line
        $configuration = new YamlConfiguration('~/.php-utility.yaml');
        $client->setUsername($configuration->getString('mediawiki-username'));
        $client->setPassword($configuration->getString('mediawiki-password'));
        $client->login();
        $content = $client->getPage('Main_Page');
        $this::assertStringContainsString('MediaWiki has been installed', $content);
    }
}
