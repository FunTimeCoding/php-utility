<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

class Cat extends Animal
{
    public function eat(AnimalFood $food): void
    {
        $food->nom();
    }

    public function meow(): void
    {
        echo 'The cat says meow.'.PHP_EOL;
    }
}
