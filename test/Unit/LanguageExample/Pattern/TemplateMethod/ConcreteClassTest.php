<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\TemplateMethod;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\TemplateMethod\ConcreteClass;
use PHPUnit_Framework_TestCase;

class ConcreteClassTest extends PHPUnit_Framework_TestCase
{
    public function testTemplateMethodCall()
    {
        $object = new ConcreteClass();

        $result = $object->anotherMethod();

        $this->assertEquals(0, $result);
    }
}
