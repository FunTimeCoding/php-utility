<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

class MediaWikiTestHelper
{
    public function validateQueryData(array $queryData): bool
    {
        if (!array_key_exists('title', $queryData)) {
            return false;
        }

        if (!array_key_exists('action', $queryData)) {
            return false;
        }

        if (!array_key_exists('type', $queryData)) {
            return false;
        }

        return true;
    }
}
