<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern;

class PersonRegistry
{
    /**
     * @var Person[]
     */
    private $personList = [];

    public function addPerson(Person $person): void
    {
        $this->personList[] = $person;
    }

    public function getPersonByName(string $name): ?Person
    {
        foreach ($this->personList as $person) {
            if ($person->getName() === $name) {
                return $person;
            }
        }

        return null;
    }
}
