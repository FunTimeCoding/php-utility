<?php

declare(strict_types=1);

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
     * @var Client
     */
    private $client;

    public function __construct(string $locator)
    {
        $this->locator = $locator;
        $this->client = new Client(['cookies' => true]);
    }

    /**
     * @throws FrameworkException
     */
    public function getPage(string $page): string
    {
        $helper = new MediaWikiHelper();

        // TODO: Remove after this is resolved https://github.com/guzzle/guzzle/issues/2184
        /**
         * @psalm-suppress InvalidCatch
         */
        try {
            $response = $this->client->request('GET', $this->locator . '/' . $page);
        } catch (GuzzleException $e) {
            throw new FrameworkException($e->getMessage());
        }

        $xpath = $helper->createDomXpathForBody((string)$response->getBody());

        return $helper->searchContentInDomXpath($xpath) ?? '';
    }

    /**
     * @throws FrameworkException
     */
    public function login(): void
    {
        $helper = new MediaWikiHelper();

        // TODO: Remove after this is resolved https://github.com/guzzle/guzzle/issues/2184
        /**
         * @psalm-suppress InvalidCatch
         */
        try {
            $response = $this->client->request(
                'GET',
                $this->locator,
                ['query' => $helper->getLoginLocatorQueryData()]
            );
        } catch (GuzzleException $e) {
            throw new FrameworkException($e->getMessage());
        }

        $xpath = $helper->createDomXpathForBody((string)$response->getBody());
        $token = $helper->searchTokenInDomXpath($xpath);

        if ($token === null) {
            throw new FrameworkException('Could not find token.');
        }

        // TODO: Remove after this is resolved https://github.com/guzzle/guzzle/issues/2184
        /**
         * @psalm-suppress InvalidCatch
         */
        try {
            $response = $this->client->request(
                'POST',
                $this->locator,
                [
                    'query' => $helper->getLoginLocatorQueryData(),
                    'form_params' => $this->createFormDataWithToken($token)
                ]
            );
        } catch (GuzzleException $e) {
            throw new FrameworkException($e->getMessage());
        }

        $xpath = $helper->createDomXpathForBody((string)$response->getBody());
        $node = $xpath->query('//li[@id="pt-logout"]');

        if ($node === false || $node->length !== 1) {
            throw new FrameworkException('Login failed.');
        }
    }

    /**
     * @return array<string>
     */
    public function createFormDataWithToken(string $token): array
    {
        return [
            'wpName' => $this->username,
            'wpPassword' => $this->password,
            'wpLoginAttempt' => 'Log in',
            'wpEditToken' => '+\\',
            'authAction' => 'login',
            'wpLoginToken' => $token,
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
