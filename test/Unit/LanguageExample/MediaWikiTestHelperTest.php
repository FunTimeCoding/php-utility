<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use PHPUnit\Framework\TestCase;

class MediaWikiTestHelperTest extends TestCase
{
    public function testValid(): void
    {
        $helper = new MediaWikiTestHelper();

        $queryData = [
            'title' => 'value_not_tested',
            'action' => 'value_not_tested',
            'type' => 'value_not_tested',
        ];

        $this->assertTrue($helper->validateQueryData($queryData));
    }

    public function testTitleMissing(): void
    {
        $helper = new MediaWikiTestHelper();

        $actionMissing = [
            'action' => 'value_not_tested',
            'type' => 'value_not_tested',
        ];

        $this->assertFalse($helper->validateQueryData($actionMissing));
    }

    public function testActionMissing(): void
    {
        $helper = new MediaWikiTestHelper();

        $actionMissing = [
            'title' => 'value_not_tested',
            'type' => 'value_not_tested',
        ];

        $this->assertFalse($helper->validateQueryData($actionMissing));
    }

    public function testTypeMissing(): void
    {
        $helper = new MediaWikiTestHelper();

        $actionMissing = [
            'title' => 'value_not_tested',
            'action' => 'value_not_tested',
        ];

        $this->assertFalse($helper->validateQueryData($actionMissing));
    }
}
