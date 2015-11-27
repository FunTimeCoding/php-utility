<?php

namespace FunTimeCoding\PhpUtility\Test\Integration\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\CurlMediaWikiWebClient;
use FunTimeCoding\PhpUtility\LanguageExample\HttpRequestMediaWikiWebClient;
use FunTimeCoding\PhpUtility\LanguageExample\MediaWikiWebClient;
use FunTimeCoding\PhpUtility\Framework\YamlConfig;
use PHPUnit_Framework_TestCase;

class MediaWikiWebClientTest extends PHPUnit_Framework_TestCase
{
    public function testLoginWithHttpRequestLibrary()
    {
        $httpRequestClient = new HttpRequestMediaWikiWebClient('mediawiki.dev');
        $curlClient = new CurlMediaWikiWebClient('mediawiki.dev');

        $config = new YamlConfig('~/.php-utility.yml');
        $username = $config->get('wpName');
        $password = $config->get('wpPassword');

        $clients = array($httpRequestClient, $curlClient);

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
