<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use PHPUnit\Framework\TestCase;

class MediaWikiTestHelperTest extends TestCase
{
    public function testValid()
    {
        $helper = new MediaWikiTestHelper();

        $queryData = array(
            'title' => 'value_not_tested',
            'action' => 'value_not_tested',
            'type' => 'value_not_tested',
        );

        $this->assertTrue($helper->validateQueryData($queryData));
    }

    public function testTitleMissing()
    {
        $helper = new MediaWikiTestHelper();

        $actionMissing = array(
            'action' => 'value_not_tested',
            'type' => 'value_not_tested',
        );

        $this->assertFalse($helper->validateQueryData($actionMissing));
    }

    public function testActionMissing()
    {
        $helper = new MediaWikiTestHelper();

        $actionMissing = array(
            'title' => 'value_not_tested',
            'type' => 'value_not_tested',
        );

        $this->assertFalse($helper->validateQueryData($actionMissing));
    }

    public function testTypeMissing()
    {
        $helper = new MediaWikiTestHelper();

        $actionMissing = array(
            'title' => 'value_not_tested',
            'action' => 'value_not_tested',
        );

        $this->assertFalse($helper->validateQueryData($actionMissing));
    }
}
