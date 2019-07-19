<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

interface CanEatInterface
{
    public function eat(AnimalFood $food): void;
}
