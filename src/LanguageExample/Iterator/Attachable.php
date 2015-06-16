<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

interface Attachable
{
    /**
     * @param $object
     * @param mixed|null $data
     */
    public function attach($object, $data = null);
}
