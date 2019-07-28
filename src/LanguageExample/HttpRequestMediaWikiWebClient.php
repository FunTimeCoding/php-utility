<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use FunTimeCoding\PhpUtility\Framework\FrameworkException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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
     * @throws FrameworkException
     */
    public function getPage(string $page): string
    {
        $helper = new MediaWikiHelper();
        $client = new Client();
        // TODO: Enable cookies?

        try {
            $response = $client->request('GET', $this->locator . '/' . $page);
        } catch (GuzzleException $e) {
            throw new FrameworkException($e->getMessage());
        }

        return $helper->searchContentInDomXpath(
            $helper->createDomXpathForBody((string)$response->getBody())
            ) ?? '';
    }

    /**
     * @throws FrameworkException
     */
    public function login(): void
    {
        $helper = new MediaWikiHelper();
        $query = [];

        foreach ($helper->getLoginLocatorQueryData() as $key => $value) {
            $query[] = $key . '=' . $value;
        }

        $loginLocator = $this->locator . '?' . implode('&', $query);
        $client = new Client();

        try {
            $response = $client->request('GET', $loginLocator);
        } catch (GuzzleException $e) {
            throw new FrameworkException($e->getMessage());
        }

        $xpath = $helper->createDomXpathForBody((string)$response->getBody());
        $token = $helper->searchTokenInDomXpath($xpath);

        if ($token === null) {
            throw new FrameworkException('Could not find token.');
        }

        try {
            $response = $client->request(
                'POST',
                $loginLocator,
                $this->createFormDataWithToken($token)
            );
        } catch (GuzzleException $e) {
            throw new FrameworkException($e->getMessage());
        }

        $xpath = $helper->createDomXpathForBody((string)$response->getBody());

        if (1 !== $xpath->query('//li[@id="pt-logout"]')->length) {
            throw new FrameworkException('Login failed.');
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
