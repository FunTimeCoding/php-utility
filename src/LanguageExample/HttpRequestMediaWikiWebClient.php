<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use Exception;
use GuzzleHttp\Client;

class HttpRequestMediaWikiWebClient implements MediaWikiWebClient
{
    private $username = '';

    private $password = '';

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
     */
    public function getPage($page)
    {
        $helper = new MediaWikiHelper();
        $client = new Client();
        // TODO: Enable cookies?
        $response = $client->request('GET', $this->locator . '/' . $page);

        return $helper->searchContentInDomXpath(
            $helper->createDomXpathForBody($response->getBody())
        );
    }

    /**
     * @throws Exception
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

        if (1 != $xpath->query('//li[@id="pt-logout"]')->length) {
            throw new Exception('Login failed.');
        }
    }

    /**
     * @internal
     *
     * @param string $token
     *
     * @return array
     */
    public function createFormDataWithToken($token)
    {
        return [
            'wpName' => $this->username,
            'wpPassword' => $this->password,
            'wpLoginAttempt' => 'Log in',
            'wpLoginToken' => $token,
            'wpRemember' => '1',
        ];
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
}
