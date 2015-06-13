<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern;

class Person
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
}
