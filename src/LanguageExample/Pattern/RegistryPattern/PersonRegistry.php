<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern;

class PersonRegistry
{
    /**
     * @var Person[]
     */
    private $personList = array();

    public function addPerson(Person $person)
    {
        $this->personList[] = $person;
    }

    /**
     * @param string $name
     *
     * @return Person
     */
    public function getPersonByName($name)
    {
        foreach($this->personList as $person)
        {
            if($person->getName() === $name)
            {
                return $person;
            }
        }

        return null;
    }
}
