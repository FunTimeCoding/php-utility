<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

class AnimalFood
{
    public function nom(): void
    {
        echo 'AnimalFood has been eaten.'.PHP_EOL;
    }
}
