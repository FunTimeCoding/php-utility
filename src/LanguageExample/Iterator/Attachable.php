<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

interface Attachable
{
    /**
     * @param mixed $object
     * @param mixed|null $data
     */
    public function attach($object, $data = null): void;
}
