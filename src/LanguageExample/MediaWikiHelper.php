<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use DOMDocument;
use DOMXPath;

class MediaWikiHelper
{
    public function getLoginLocatorQueryData(): array
    {
        return [
            'title' => 'Special:UserLogin',
            'action' => 'submitlogin',
            'type' => 'login',
        ];
    }

    public function createDomXpathForBody(string $body): DOMXPath
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($body);
        libxml_clear_errors();

        return new DOMXPath($dom);
    }

    public function searchTokenInDomXpath(DOMXPath $xpath): ?string
    {
        return $xpath->query('//input[@name="wpLoginToken"]/@value')->item(0)->nodeValue;
    }

    public function searchContentInDomXpath(DOMXPath $xpath): ?string
    {
        return trim($xpath->query('//div[@id="mw-content-text"]')->item(0)->nodeValue);
    }
}
