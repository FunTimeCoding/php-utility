<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\RegistryPattern;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\RegistryPattern\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    public function testName(): void
    {
        $testName = 'alex';
        $person = new Person($testName);

        $name = $person->getName();

        $this->assertEquals($testName, $name);
    }
}
