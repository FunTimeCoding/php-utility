<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

class MediaWikiTestHelper
{
    public function validateQueryData(array $queryData)
    {
        if (!array_key_exists('title', $queryData)) {
            return false;
        } elseif (!array_key_exists('action', $queryData)) {
            return false;
        } elseif (!array_key_exists('type', $queryData)) {
            return false;
        }

        return true;
    }
}
