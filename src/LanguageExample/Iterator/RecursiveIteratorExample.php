<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use RecursiveArrayIterator;
use RecursiveCallbackFilterIterator;
use RecursiveIteratorIterator;
use RecursiveTreeIterator;

class RecursiveIteratorExample
{
    public function recursiveArrayIterator()
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(
                [
                    ['apple', 'banana', 'strawberry'],
                    ['blueberry', 'plum', 'orange']
                ]
            )
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    public function recursiveArrayIteratorWithWhileLoop()
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator(
                [
                    ['apple', 'banana', 'strawberry'],
                    ['blueberry', 'plum', 'orange'],
                ]
            )
        );
        // Do not forget to rewind when using while, because foreach does that.
        $iterator->rewind();

        while ($iterator->valid()) {
            $key = $iterator->key();
            $value = $iterator->current();
            echo $key . ' ' . $value . PHP_EOL;
            $iterator->next();
        }
    }

    public function iterator()
    {
        $cupboard = new Cupboard();
        $cupboard->lowerDrawer = 'books';
        $cupboard->upperDrawer = 'clothes';

        foreach ($cupboard as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    /**
     * FIXME: I have no clue how to use this properly.
     * @see http://php.net/manual/en/class.recursivecallbackfilteriterator.php
     */
    public function recursiveCallbackFilterIterator()
    {
        $appleFilterCallback = function ($current, $key, $iterator) {
            $result = false;

            /*
             * @var RecursiveArrayIterator
             */
            if ($iterator->hasChildren()) {
                $result = true;
            } elseif (is_string($current) && $current == 'apple') {
                $result = true;
            }

            return $result;
        };
        $iterator = new RecursiveCallbackFilterIterator(
            new RecursiveArrayIterator(
                [
                    ['apple', 'banana', 'strawberry'],
                    ['apple', 'blueberry', 'plum', 'orange'],
                ]
            ),
            $appleFilterCallback
        );

        foreach ($iterator as $key => $value) {
            echo print_r($key, true) . ' ' . print_r($value, true) . PHP_EOL;
        }
    }

    public function recursiveTreeIterator()
    {
        $iterator = new RecursiveTreeIterator(
            new RecursiveArrayIterator([['a', ['b', 'c']], ['d', 'e']])
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }
}
