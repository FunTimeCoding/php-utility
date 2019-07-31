<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample;

use DOMDocument;
use DOMXPath;
use FunTimeCoding\PhpUtility\Framework\FrameworkException;

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
        $model = new DOMDocument();
        libxml_use_internal_errors(true);
        $model->loadHTML($body);
        libxml_clear_errors();

        return new DOMXPath($model);
    }

    /**
     * @param DOMXPath $xpath
     *
     * @return string|null
     * @throws FrameworkException
     */
    public function searchTokenInDomXpath(DOMXPath $xpath): ?string
    {
        $queryResult = $xpath->query('//input[@name="wpLoginToken"]/@value');

        if ($queryResult->count() > 0) {
            $node = $queryResult->item(0);

            if ($node === null) {
                throw new FrameworkException(
                    'Could not get first item in query result.'
                );
            }

            return $node->nodeValue;
        }

        return null;
    }

    /**
     * @param DOMXPath $xpath
     *
     * @return string|null
     * @throws FrameworkException
     */
    public function searchContentInDomXpath(DOMXPath $xpath): ?string
    {
        $queryResult = $xpath->query('//div[@id="mw-content-text"]');

        if ($queryResult->count() > 0) {
            $node = $queryResult->item(0);

            if ($node === null) {
                throw new FrameworkException(
                    'Could not get first item in query result.'
                );
            }

            return trim($node->nodeValue);
        }

        return null;
    }
}
