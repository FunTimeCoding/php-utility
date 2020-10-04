<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

interface Attachable
{
    /**
     * @param mixed $key
     * @param mixed|null $value
     */
    public function attach($key, $value = null): void;
}
