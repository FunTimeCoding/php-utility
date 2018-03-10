<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern;

class PersonRegistry
{
    /**
     * @var Person[]
     */
    private $personList = [];

    public function addPerson(Person $person)
    {
        $this->personList[] = $person;
    }

    /**
     * @param string $name
     *
     * @return Person|null
     */
    public function getPersonByName($name)
    {
        foreach ($this->personList as $person) {
            if ($person->getName() === $name) {
                return $person;
            }
        }

        return null;
    }
}
