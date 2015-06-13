<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\RegistryPattern;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern\Person;
use PHPUnit_Framework_TestCase;

class PersonTest extends PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $testName = 'alex';
        $person = new Person($testName);

        $name = $person->getName();

        $this->assertEquals($testName, $name);
    }
}
