<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use FunTimeCoding\PhpUtility\Framework\FrameworkException;

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
    private $wikiLocator;

    /**
     * @var string
     */
    private $cookieJar = '/tmp/php-cookie-jar';

    /**
     * @param string $domainName
     */
    public function __construct($domainName)
    {
        $this->wikiLocator = 'http://' . $domainName . '/index.php';
    }

    /**
     * @param string $page
     * @return string
     */
    public function getPage(string $page): string
    {
        $helper = new MediaWikiHelper();

        $body = $this->makeCurlGetRequestAndReadCookies($this->wikiLocator . '/' . $page);
        $xpath = $helper->createDomXpathForBody($body);

        return $helper->searchContentInDomXpath($xpath) ?? '';
    }

    public function makeCurlGetRequestAndReadCookies(string $locator): string
    {
        $request = $this->createCurlRequest($locator);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_COOKIEFILE, $this->cookieJar);

        return $this->executeCurlRequest($request);
    }

    /**
     * @param string $locator
     * @return resource
     */
    public function createCurlRequest(string $locator)
    {
        $request = curl_init();

        curl_setopt($request, CURLOPT_URL, $locator);

        return $request;
    }

    /**
     * @param resource $request
     *
     * @return string
     */
    public function executeCurlRequest($request): string
    {
        $body = curl_exec($request);
        curl_close($request);

        return (string)$body;
    }

    /**
     * @throws FrameworkException
     */
    public function login(): void
    {
        $helper = new MediaWikiHelper();

        $locator = $this->wikiLocator . '?' . http_build_query($helper->getLoginLocatorQueryData());
        $token = $helper->searchTokenInDomXpath(
            $helper->createDomXpathForBody(
                $this->makeCurlGetRequestAndWriteCookies($locator)
            )
        );

        if ($token === null) {
            throw new FrameworkException('Could not find token.');
        }

        $xpath = $helper->createDomXpathForBody(
            $this->makeCurlPostRequest(
                $locator,
                $this->createFormDataWithToken($token)
            )
        );

        if (1 !== $xpath->query('//li[@id="pt-logout"]')->length) {
            throw new FrameworkException('Login failed.');
        }
    }

    public function makeCurlGetRequestAndWriteCookies(string $locator): string
    {
        $request = $this->createCurlRequest($locator);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_COOKIEJAR, $this->cookieJar);

        return $this->executeCurlRequest($request);
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

    public function makeCurlPostRequest(string $locator, array $formData): string
    {
        $request = $this->createCurlRequest($locator);
        curl_setopt($request, CURLOPT_POST, count($formData));
        curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($formData));
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_COOKIEJAR, $this->cookieJar);
        curl_setopt($request, CURLOPT_COOKIEFILE, $this->cookieJar);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);

        return $this->executeCurlRequest($request);
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
