<?php

namespace FunTimeCoding\PhpUtility\Test\Integration\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\CurlMediaWikiWebClient;
use FunTimeCoding\PhpUtility\LanguageExample\HttpRequestMediaWikiWebClient;
use FunTimeCoding\PhpUtility\LanguageExample\MediaWikiWebClient;
use FunTimeCoding\PhpUtility\Framework\YamlConfig;
use PHPUnit\Framework\TestCase;

class MediaWikiWebClientTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testLoginWithHttpRequestLibrary(): void
    {
        $httpRequestClient = new HttpRequestMediaWikiWebClient('mediawiki.dev');
        $curlClient = new CurlMediaWikiWebClient('mediawiki.dev');

        $config = new YamlConfig('~/.php-utility.yaml');
        $username = $config->get('wpName');
        $password = $config->get('wpPassword');

        $clients = [$httpRequestClient, $curlClient];

        foreach ($clients as $client) {
            /* @var MediaWikiWebClient $client */
            $client->setUsername($username);
            $client->setPassword($password);
            $client->login();
            $content = $client->getPage('Test_Page');
            $this->assertEquals('test text', $content);
        }
    }
}
