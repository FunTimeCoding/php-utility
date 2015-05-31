<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use DOMDocument;
use DOMXPath;
use FunTimeCoding\PhpUtility\LanguageExample\MediaWikiHelper;
use PHPUnit_Framework_TestCase;

class MediaWikiHelperTest extends PHPUnit_Framework_TestCase
{
    public function testQueryData()
    {
        $helper = new MediaWikiHelper();
        $testHelper = new MediaWikiTestHelper();

        $queryData = $helper->getLoginUrlQueryData();

        $this->assertTrue($testHelper->validateQueryData($queryData));
    }

    public function testSearchTokenInDomXpath()
    {
        $helper = new MediaWikiHelper();
        $token = 'MyToken';
        $html = '<form><input name="wpLoginToken" value="'.$token.'"></form>';
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $result = $helper->searchTokenInDomXpath($xpath);

        $this->assertEquals($token, $result);
    }

    public function testSearchContentInDomXpath()
    {
        $helper = new MediaWikiHelper();
        $content = 'MyContent';
        $html = '<div id="mw-content-text">'.$content.'</div>';
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $result = $helper->searchContentInDomXpath($xpath);

        $this->assertEquals($content, $result);
    }
}
