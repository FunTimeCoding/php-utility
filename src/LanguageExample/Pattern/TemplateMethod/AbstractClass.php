<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\TemplateMethod;

abstract class AbstractClass
{
    /**
     * The point is that this method always remains the same.
     *
     * @return int
     */
    final public function templateMethod(): int
    {
        return 0;
    }

    abstract public function anotherMethod(): int;
}
