<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

class Animal implements CanEatInterface
{
    public function eat(AnimalFood $food): void
    {
        $food->nom();
    }
}
