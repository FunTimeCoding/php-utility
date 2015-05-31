<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use DOMDocument;
use DOMXPath;

class MediaWikiHelper
{
    /**
     * @return array
     */
    public function getLoginUrlQueryData()
    {
        return array(
            'title' => 'Special:UserLogin',
            'action' => 'submitlogin',
            'type' => 'login',
        );
    }

    /**
     * @param string $body
     *
     * @return DOMXPath
     */
    public function createDomXpathForBody($body)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($body);
        libxml_clear_errors();

        return new DOMXPath($dom);
    }

    /**
     * @param DOMXPath $xpath
     *
     * @return string
     */
    public function searchTokenInDomXpath(DOMXPath $xpath)
    {
        return $xpath->query('//input[@name="wpLoginToken"]/@value')->item(0)->nodeValue;
    }

    /**
     * @param DOMXPath $xpath
     *
     * @return string
     */
    public function searchContentInDomXpath(DOMXPath $xpath)
    {
        return trim($xpath->query('//div[@id="mw-content-text"]')->item(0)->nodeValue);
    }
}
