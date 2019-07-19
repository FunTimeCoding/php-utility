<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\TemplateMethod;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\TemplateMethod\ConcreteClass;
use PHPUnit\Framework\TestCase;

class ConcreteClassTest extends TestCase
{
    public function testTemplateMethodCall(): void
    {
        $object = new ConcreteClass();

        $result = $object->anotherMethod();

        $this->assertEquals(0, $result);
    }
}
