<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

class Cat extends Animal
{
    public function eat(AnimalFood $food)
    {
        $food->nom();
    }

    public function meow()
    {
        echo 'The cat says meow.'.PHP_EOL;
    }
}
