<?php
namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

class InheritanceMain
{
    public function main()
    {
        $c = new CatFood();
        $a = new Cat();
        $a->eat($c);

        $d = new MoreSpecificCatFood();
        $b = new MoreSpecificCat();
        $b->eat($d);
    }
}
