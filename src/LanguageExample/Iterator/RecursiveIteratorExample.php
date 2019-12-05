<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use CachingIterator;
use RecursiveArrayIterator;
use RecursiveCallbackFilterIterator;
use RecursiveIteratorIterator;
use RecursiveTreeIterator;

class RecursiveIteratorExample
{
    public function recursiveArrayIterator(): void
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

    public function recursiveArrayIteratorWithWhileLoop(): void
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

    public function iterator(): void
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
    public function recursiveCallbackFilterIterator(): void
    {
        // Not all parameters have to be used.
        // @phan-suppress-next-line PhanUnusedClosureParameter
        $appleFilterCallback = static function ($current, $key, $iterator) {
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

    public function recursiveTreeIterator(): void
    {
        $iterator = new RecursiveTreeIterator(
            new RecursiveArrayIterator([['a', ['b', 'c']], ['d', 'e']]),
            RecursiveTreeIterator::BYPASS_KEY,
            CachingIterator::CATCH_GET_CHILD,
            RecursiveTreeIterator::SELF_FIRST
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }
}
