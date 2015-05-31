<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\TemplateMethod;

class ConcreteClass extends AbstractClass
{
    /**
     * @return int
     */
    public function anotherMethod()
    {
        return $this->templateMethod();
    }
}
