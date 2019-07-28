<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

class User
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $age;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }
}
