<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\TemplateMethod;

abstract class AbstractClass
{
    /**
     * The point is that this method always remains the same.
     *
     * @return int
     */
    final public function templateMethod()
    {
        return 0;
    }

    abstract public function anotherMethod();
}
