<?php
namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

class Animal implements CanEatInterface
{
    public function eat(AnimalFood $food)
    {
    }
}
