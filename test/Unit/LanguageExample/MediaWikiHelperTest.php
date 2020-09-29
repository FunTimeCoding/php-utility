<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use DOMDocument;
use DOMXPath;
use FunTimeCoding\PhpUtility\Framework\FrameworkException;
use FunTimeCoding\PhpUtility\LanguageExample\MediaWikiHelper;
use PHPUnit\Framework\TestCase;

class MediaWikiHelperTest extends TestCase
{
    public function testQueryData(): void
    {
        $helper = new MediaWikiHelper();

        $query = $helper->getLoginLocatorQueryData();

        $this::assertArrayHasKey('title', $query);
        $this::assertArrayHasKey('returnto', $query);
    }

    /**
     * @throws FrameworkException
     */
    public function testSearchTokenInDomXpath(): void
    {
        $helper = new MediaWikiHelper();
        $token = 'MyToken';
        $html = '<form><input name="wpLoginToken" value="'.$token.'"></form>';
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $result = $helper->searchTokenInDomXpath($xpath);

        $this::assertEquals($token, $result);
    }

    /**
     * @throws FrameworkException
     */
    public function testSearchContentInDomXpath(): void
    {
        $helper = new MediaWikiHelper();
        $content = 'MyContent';
        $html = '<div id="mw-content-text">'.$content.'</div>';
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $result = $helper->searchContentInDomXpath($xpath);

        $this::assertEquals($content, $result);
    }
}
