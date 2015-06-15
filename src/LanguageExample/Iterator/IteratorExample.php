<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class IteratorExample
{
    public function arrayIterator()
    {
        $fruits = array(
            'apple',
            'banana',
            'strawberry'
        );

        $iterator = new ArrayIterator($fruits);
        $iterator->rewind();

        while ($iterator->valid()) {
            $key = $iterator->key();
            $value = $iterator->current();
            echo $key . ' ' . $value . PHP_EOL;
            $iterator->next();
        }
    }

    public function recursiveArrayIteratorWithForeach()
    {
        $fruits = array(
            array(
                'apple',
                'banana',
                'strawberry'
            ),
            array(
                'blueberry',
                'plum',
                'orange'
            ),
        );

        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($fruits));

        foreach($iterator as $key => $value) {
            echo print_r($key, true) . ' ' . print_r($value, true) . PHP_EOL;
        }
    }

    public function recursiveArrayIteratorWithWhile()
    {
        $fruits = array(
            array(
                'apple',
                'banana',
                'strawberry'
            ),
            array(
                'blueberry',
                'plum',
                'orange'
            ),
        );

        $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($fruits));
        $iterator->rewind();

        while ($iterator->valid()) {
            $key = $iterator->key();
            $value = $iterator->current();
            echo print_r($key, true) . ' ' . print_r($value, true) . PHP_EOL;
            $iterator->next();
        }
    }

    public function iterator()
    {
        $cupboard = new Cupboard();
        $cupboard->lowerDrawer = 'books';
        $cupboard->upperDrawer = 'clothes';

        // TODO: use foreach
        $cupboard->rewind();

        while ($cupboard->valid()) {
            $key = $cupboard->key();
            $value = $cupboard->current();
            echo $key . ' ' . $value . PHP_EOL;
            $cupboard->next();
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
        $innerIterator = new ArrayIterator($users);
        $iterator = new UserAgeFilterIterator($innerIterator, 25, 40);
        $iterator->rewind();

        while ($iterator->valid()) {
            /** @var User $user */
            $user = $iterator->current();
            echo $user->getName() . ' ' . $user->getAge() . PHP_EOL;
            $iterator->next();
        }
    }
}
