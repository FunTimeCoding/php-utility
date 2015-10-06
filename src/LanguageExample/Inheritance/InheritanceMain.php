<?php
namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

/**
 * Liskov Substitution Principle in simple terms.
 * An overridden method in a subclass must..
 * 1. match the parent signature.
 * 2. accept the same or weaker preconditions.
 * 3. expect the same or stronger postcondition.
 * 4. not introduce new or different exceptions.
 */
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
        $cat->meow();
    }
}

if (count(debug_backtrace()) == 0) {
    require_once __DIR__.'/../../../vendor/autoload.php';
    $application = new InheritanceMain();
    $application->main();
}
