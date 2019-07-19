<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use Exception;
use GuzzleHttp\Client;

class HttpRequestMediaWikiWebClient implements MediaWikiWebClient
{
    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var string
     */
    private $locator;

    /**
     * @param string $domainName
     */
    public function __construct($domainName)
    {
        $this->locator = 'http://' . $domainName . '/index.php';
    }

    /**
     * @param string $page
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPage(string $page): string
    {
        $helper = new MediaWikiHelper();
        $client = new Client();
        // TODO: Enable cookies?
        $response = $client->request('GET', $this->locator . '/' . $page);

        return $helper->searchContentInDomXpath(
            $helper->createDomXpathForBody((string)$response->getBody())
        );
    }

    /**
     * @throws Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login()
    {
        $helper = new MediaWikiHelper();
        $query = [];

        foreach ($helper->getLoginLocatorQueryData() as $key => $value) {
            $query[] = $key . '=' . $value;
        }

        $locator = $this->locator . '?' . join('&', $query);
        $client = new Client();
        $response = $client->request('GET', $locator);
        $xpath = $helper->createDomXpathForBody($response->getBody());
        $response = $client->request(
            'POST',
            $locator,
            $this->createFormDataWithToken(
                $helper->searchTokenInDomXpath($xpath)
            )
        );
        $response = $client->request('GET', $response->getHeader('Location'));
        $xpath = $helper->createDomXpathForBody($response->getBody());

        if (1 !== $xpath->query('//li[@id="pt-logout"]')->length) {
            throw new Exception('Login failed.');
        }
    }

    public function createFormDataWithToken(string $token): array
    {
        return [
            'wpName' => $this->username,
            'wpPassword' => $this->password,
            'wpLoginAttempt' => 'Log in',
            'wpLoginToken' => $token,
            'wpRemember' => '1',
        ];
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}
