<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Inheritance;

class CatFood extends AnimalFood
{
    public function nom(): void
    {
        echo 'CatFood has been eaten.'.PHP_EOL;
    }
}
