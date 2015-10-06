<?php
namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

class InheritanceMain
{
    public function main()
    {
        $animalFood = new AnimalFood();
        $animal = new Animal();
        $animal->eat($animalFood);

        $catFood = new CatFood();
        $cat = new Cat();
        $cat->eat($catFood);
    }
}
