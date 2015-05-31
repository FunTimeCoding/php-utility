<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use Exception;
use HttpRequest;

class HttpRequestMediaWikiWebClient implements MediaWikiWebClient
{
    private $username = '';
    private $password = '';
    private $url;

    /**
     * @param string $domainName
     */
    public function __construct($domainName)
    {
        $this->url = 'http://'.$domainName.'/index.php';
    }

    /**
     * @param string $page
     *
     * @return string
     */
    public function getPage($page)
    {
        $helper = new MediaWikiHelper();

        $request = new HttpRequest($this->url.'/'.$page, HttpRequest::METH_GET);
        $request->enableCookies();
        $request->send();
        $body = $request->getResponseBody();
        $xpath = $helper->createDomXpathForBody($body);

        return $helper->searchContentInDomXpath($xpath);
    }

    /**
     * @throws Exception
     */
    public function login()
    {
        $helper = new MediaWikiHelper();

        $request = new HttpRequest($this->url, HttpRequest::METH_GET);
        $request->enableCookies();
        $request->addQueryData($helper->getLoginUrlQueryData());
        $request->send();
        $body = $request->getResponseBody();
        $xpath = $helper->createDomXpathForBody($body);
        $token = $helper->searchTokenInDomXpath($xpath);

        $request = new HttpRequest($this->url, HttpRequest::METH_POST);
        $request->addQueryData($helper->getLoginUrlQueryData());
        $formData = $this->createFormDataWithToken($token);
        $request->addPostFields($formData);
        $response = $request->send();
        $location = $response->getHeader('Location');

        $request = new HttpRequest($location, HttpRequest::METH_GET);
        $request->send();
        $body = $request->getResponseBody();
        $xpath = $helper->createDomXpathForBody($body);

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
        return array(
            'wpName' => $this->username,
            'wpPassword' => $this->password,
            'wpLoginAttempt' => 'Log in',
            'wpLoginToken' => $token,
            'wpRemember' => '1',
        );
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
