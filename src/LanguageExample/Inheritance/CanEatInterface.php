<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

interface CanEatInterface
{
    public function eat(AnimalFood $food): void;
}
