<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use Exception;

class CurlMediaWikiWebClient implements MediaWikiWebClient
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
    private $wikiUrl;

    /**
     * @var string
     */
    private $cookieJar = '/tmp/php-cookie-jar';

    /**
     * @param string $domainName
     */
    public function __construct($domainName)
    {
        $this->wikiUrl = 'http://'.$domainName.'/index.php';
    }

    public function getPage(string $page): string
    {
        $helper = new MediaWikiHelper();

        $body = $this->makeCurlGetRequestAndReadCookies($this->wikiUrl.'/'.$page);
        $xpath = $helper->createDomXpathForBody($body);

        return $helper->searchContentInDomXpath($xpath);
    }

    public function makeCurlGetRequestAndReadCookies(string $url): string
    {
        $request = $this->createCurlRequest($url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_COOKIEFILE, $this->cookieJar);

        return $this->executeCurlRequest($request);
    }

    public function createCurlRequest(string $url)
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, $url);

        return $request;
    }

    /**
     * @internal
     *
     * @param resource $request
     *
     * @return string
     */
    public function executeCurlRequest($request): string
    {
        $body = curl_exec($request);
        curl_close($request);

        return (string) $body;
    }

    /**
     * @throws Exception
     */
    public function login(): void
    {
        $helper = new MediaWikiHelper();

        $url = $this->wikiUrl.'?'.http_build_query($helper->getLoginLocatorQueryData());
        $body = $this->makeCurlGetRequestAndWriteCookies($url);
        $xpath = $helper->createDomXpathForBody($body);
        $token = $helper->searchTokenInDomXpath($xpath);

        $formData = $this->createFormDataWithToken($token);
        $body = $this->makeCurlPostRequest($url, $formData);
        $xpath = $helper->createDomXpathForBody($body);

        if (1 != $xpath->query('//li[@id="pt-logout"]')->length) {
            throw new Exception('Login failed.');
        }
    }

    /**
     * @internal
     *
     * @param string $url
     *
     * @return string
     */
    public function makeCurlGetRequestAndWriteCookies($url)
    {
        $request = $this->createCurlRequest($url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_COOKIEJAR, $this->cookieJar);

        return $this->executeCurlRequest($request);
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
     * @internal
     *
     * @param string $url
     * @param array  $formData
     *
     * @return string
     */
    public function makeCurlPostRequest($url, array $formData)
    {
        $request = $this->createCurlRequest($url);
        curl_setopt($request, CURLOPT_POST, count($formData));
        curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($formData));
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_COOKIEJAR, $this->cookieJar);
        curl_setopt($request, CURLOPT_COOKIEFILE, $this->cookieJar);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);

        return $this->executeCurlRequest($request);
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}
