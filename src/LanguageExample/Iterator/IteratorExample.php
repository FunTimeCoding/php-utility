<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use CachingIterator;
use InfiniteIterator;
use LimitIterator;
use MultipleIterator;
use RegexIterator;

class IteratorExample
{
    public function arrayIterator()
    {
        $iterator = new ArrayIterator(['apple', 'banana', 'strawberry']);

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
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

    public function cachingIterator()
    {
        $iterator = new CachingIterator(
            new ArrayIterator(['apple', 'banana', 'strawberry'])
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    public function limitInfiniteIterator()
    {
        $limitIterator = new LimitIterator(
            new InfiniteIterator(
                new ArrayIterator(['apple', 'banana', 'strawberry'])
            ),
            0,
            6
        );

        foreach ($limitIterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    public function appendIterator()
    {
        $iterator = new \AppendIterator();
        $iterator->append(new ArrayIterator(['apple', 'banana', 'strawberry']));
        $iterator->append(new ArrayIterator(['bird', 'dog', 'horse']));

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    public function regexIterator()
    {
        $iterator = new RegexIterator(
            new ArrayIterator(['apple', 'banana', 'strawberry']),
            '/banana/'
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    public function multipleIterator()
    {
        $iterator = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
        $iterator->attachIterator(
            new ArrayIterator(['apple', 'banana', 'strawberry']),
            'fruit'
        );
        $iterator->attachIterator(
            new ArrayIterator(['bird', 'dog', 'horse']),
            'animal'
        );

        foreach ($iterator as $element) {
            echo print_r($element['fruit'], true) . ' ' . print_r($element['animal'], true) . PHP_EOL;
        }
    }

    public function iteratorApply()
    {
        $arrayIterator = new ArrayIterator(['apple', 'banana', 'strawberry']);

        $pickFruit = function (ArrayIterator $iterator) {
            echo 'Picking: ' . $iterator->current() . PHP_EOL;

            return true;
        };

        iterator_apply($arrayIterator, $pickFruit, [$arrayIterator]);
    }

    /**
     * @return array
     */
    public function iteratorToArray()
    {
        return iterator_to_array(new ArrayIterator(['apple', 'banana', 'strawberry']));
    }

    /**
     * @return int
     */
    public function iteratorCount()
    {
        return iterator_count(new ArrayIterator(['apple', 'banana', 'strawberry']));
    }
}
