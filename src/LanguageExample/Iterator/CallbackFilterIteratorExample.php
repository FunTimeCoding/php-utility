<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use CallbackFilterIterator;

class CallbackFilterIteratorExample
{
    public function callbackFilterIterator()
    {
        $appleFilterCallback = function ($current, $key, $iterator) {
            $result = false;

            if ($current == 'apple') {
                $result = true;
            }

            return $result;
        };
        $iterator = new CallbackFilterIterator(
            new ArrayIterator(['apple', 'banana', 'strawberry']),
            $appleFilterCallback
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }
}
