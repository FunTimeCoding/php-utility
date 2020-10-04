<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

class MediaWikiTestHelper
{
    /**
     * @param array<string> $query
     * @return bool
     */
    public function validateQueryData(array $query): bool
    {
        if (!array_key_exists('title', $query)) {
            return false;
        }

        if (!array_key_exists('action', $query)) {
            return false;
        }

        if (!array_key_exists('type', $query)) {
            return false;
        }

        return true;
    }
}
