<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\TemplateMethod;

class ConcreteClass extends AbstractClass
{
    /**
     * @return int
     */
    public function anotherMethod(): int
    {
        return $this->templateMethod();
    }
}
