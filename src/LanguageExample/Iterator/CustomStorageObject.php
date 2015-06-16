<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

class CustomStorageObject
{
    /**
     * @var string
     */
    public $name = '';

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
