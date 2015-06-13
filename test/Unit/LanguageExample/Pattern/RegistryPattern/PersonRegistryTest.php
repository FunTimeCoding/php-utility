<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\RegistryPattern;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern\Person;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern\PersonRegistry;
use PHPUnit_Framework_TestCase;

class PersonRegistryTest extends PHPUnit_Framework_TestCase
{
    public function testGetPerson()
    {
        $testName = 'alex';
        $person = new Person($testName);
        $registry = new PersonRegistry();
        $otherPersonWithSameName = new Person($testName);

        $registry->addPerson($person);
        $gottenPerson = $registry->getPersonByName($testName);

        $this->assertSame($person, $gottenPerson);
        $this->assertNotSame($otherPersonWithSameName, $gottenPerson);
    }
}
