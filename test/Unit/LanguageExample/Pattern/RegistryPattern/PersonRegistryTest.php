<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\RegistryPattern;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern\Person;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern\PersonRegistry;
use PHPUnit\Framework\TestCase;

class PersonRegistryTest extends TestCase
{
    public function testGetPerson()
    {
        $testName = 'alex';
        $person = new Person($testName);
        $registry = new PersonRegistry();

        $registry->addPerson($person);
        $gottenPerson = $registry->getPersonByName($testName);

        $this->assertSame($person, $gottenPerson);
        $this->assertNotSame(new Person($testName), $gottenPerson);
    }
}
