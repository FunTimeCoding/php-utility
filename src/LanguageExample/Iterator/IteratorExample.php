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

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
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

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
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
            /** @var User $user */
            echo $user->getName() . ' ' . $user->getAge() . PHP_EOL;
        }
    }
}
