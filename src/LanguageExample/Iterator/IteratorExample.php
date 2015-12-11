<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use CachingIterator;
use CallbackFilterIterator;
use InfiniteIterator;
use LimitIterator;
use MultipleIterator;
use RecursiveArrayIterator;
use RecursiveCallbackFilterIterator;
use RecursiveIteratorIterator;
use RecursiveTreeIterator;
use RegexIterator;

class IteratorExample
{
    public function arrayIterator()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $iterator = new ArrayIterator($fruits);

        foreach ($iterator as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    public function recursiveArrayIterator()
    {
        $fruits = array(
            array(
                'apple',
                'banana',
                'strawberry',
            ),
            array(
                'blueberry',
                'plum',
                'orange',
            ),
        );
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($fruits));

        foreach ($iterator as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    public function recursiveArrayIteratorWithWhileLoop()
    {
        $fruits = array(
            array(
                'apple',
                'banana',
                'strawberry',
            ),
            array(
                'blueberry',
                'plum',
                'orange',
            ),
        );
        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($fruits));
        // Do not forget to rewind when using while, because foreach does that.
        $iterator->rewind();

        while ($iterator->valid()) {
            $key = $iterator->key();
            $value = $iterator->current();
            echo $key.' '.$value.PHP_EOL;
            $iterator->next();
        }
    }

    public function iterator()
    {
        $cupboard = new Cupboard();
        $cupboard->lowerDrawer = 'books';
        $cupboard->upperDrawer = 'clothes';

        foreach ($cupboard as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    public function filterIterator()
    {
        $someUser = new User();
        $someUser->setName('Someone');
        $someUser->setAge(21);
        $anotherUser = new User();
        $anotherUser->setName('Another');
        $anotherUser->setAge(31);
        $users = array($someUser, $anotherUser);
        $iterator = new UserAgeFilterIterator(new ArrayIterator($users), 25, 40);

        foreach ($iterator as $user) {
            /* @var User $user */
            echo $user->getName().' '.$user->getAge().PHP_EOL;
        }
    }

    public function callbackFilterIterator()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $innerIterator = new ArrayIterator($fruits);
        $appleFilterCallback = function ($current, $key, $iterator) {
            $result = false;

            if ($current == 'apple') {
                $result = true;
            }

            return $result;
        };
        $iterator = new CallbackFilterIterator($innerIterator, $appleFilterCallback);

        foreach ($iterator as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    /**
     * FIXME: I have no clue how to use this properly.
     *
     * @see http://php.net/manual/en/class.recursivecallbackfilteriterator.php
     */
    public function recursiveCallbackFilterIterator()
    {
        $fruits = array(
            array(
                'apple',
                'banana',
                'strawberry',
            ),
            array(
                'apple',
                'blueberry',
                'plum',
                'orange',
            ),
        );
        $innerIterator = new RecursiveArrayIterator($fruits);
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
        $iterator = new RecursiveCallbackFilterIterator($innerIterator, $appleFilterCallback);

        foreach ($iterator as $key => $value) {
            echo print_r($key, true).' '.print_r($value, true).PHP_EOL;
        }
    }

    public function cachingIterator()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $innerIterator = new ArrayIterator($fruits);
        $iterator = new CachingIterator($innerIterator);

        foreach ($iterator as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    public function limitInfiniteIterator()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $arrayIterator = new ArrayIterator($fruits);
        $infiniteIterator = new InfiniteIterator($arrayIterator);
        $limitIterator = new LimitIterator($infiniteIterator, 0, 6);

        foreach ($limitIterator as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    public function recursiveTreeIterator()
    {
        $tree = array(
            array(
                'a',
                array(
                    'b',
                    'c',
                ),
            ),
            array(
                'd',
                'e',
            ),
        );
        $innerIterator = new RecursiveArrayIterator($tree);
        $iterator = new RecursiveTreeIterator($innerIterator);

        foreach ($iterator as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    public function appendIterator()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $fruitIterator = new ArrayIterator($fruits);
        $animals = array(
            'bird',
            'dog',
            'horse',
        );
        $animalIterator = new ArrayIterator($animals);
        $iterator = new \AppendIterator();
        $iterator->append($fruitIterator);
        $iterator->append($animalIterator);

        foreach ($iterator as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    public function regexIterator()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $arrayIterator = new ArrayIterator($fruits);
        $iterator = new RegexIterator($arrayIterator, '/banana/');

        foreach ($iterator as $key => $value) {
            echo $key.' '.$value.PHP_EOL;
        }
    }

    public function multipleIterator()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $fruitIterator = new ArrayIterator($fruits);
        $animals = array(
            'bird',
            'dog',
            'horse',
        );
        $animalIterator = new ArrayIterator($animals);
        $iterator = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
        $iterator->attachIterator($fruitIterator, 'fruit');
        $iterator->attachIterator($animalIterator, 'animal');

        foreach ($iterator as $element) {
            echo print_r($element['fruit'], true).' '.print_r($element['animal'], true).PHP_EOL;
        }
    }

    public function iteratorApply()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $arrayIterator = new ArrayIterator($fruits);

        $pickFruit = function (ArrayIterator $iterator) {
            echo 'Picking: '.$iterator->current().PHP_EOL;

            return true;
        };

        iterator_apply($arrayIterator, $pickFruit, array($arrayIterator));
    }

    /**
     * @return array
     */
    public function iteratorToArray()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $arrayIterator = new ArrayIterator($fruits);

        return iterator_to_array($arrayIterator);
    }

    /**
     * @return int
     */
    public function iteratorCount()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry',
        );
        $arrayIterator = new ArrayIterator($fruits);

        return iterator_count($arrayIterator);
    }
}
