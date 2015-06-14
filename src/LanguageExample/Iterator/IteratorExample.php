<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use ArrayObject;
use IteratorIterator;
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

        while ($iterator->valid()) {
            $key = $iterator->key();
            $value = $iterator->current();
            echo $key . ' ' . $value . PHP_EOL;
            $iterator->next();
        }
    }

    public function recursiveArrayIterator()
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

        while ($iterator->valid()) {
            $key = $iterator->key();
            $value = $iterator->current();
            echo print_r($key, true) . ' ' . print_r($value, true) . PHP_EOL;
            $iterator->next();
        }
    }

    /**
     * Should turn the cupboard into an iterator and traverse it.
     *
     * @see http://php.net/manual/en/class.iteratoriterator.php
     */
    public function traversableIterator()
    {
        $cupboard = new Cupboard();
        $cupboard->lowerDrawer = 'books';
        $cupboard->upperDrawer = 'clothes';
        $iterator = new IteratorIterator($cupboard);

        while ($iterator->valid()) {
            $key = $iterator->key();
            $value = $iterator->current();
            echo $key . ' ' . $value . PHP_EOL;
            $iterator->next();
        }
    }

    /**
     * Should filter out users that are not in the specified age bracket.
     *
     * @see http://php.net/manual/en/class.filteriterator.php
     */
    public function filterIterator()
    {
        $someUser = new User();
        $someUser->setName('Someone');
        $someUser->setAge(21);
        $anotherUser = new User();
        $anotherUser->setName('Another');
        $anotherUser->setAge(31);
        $users = array($someUser, $anotherUser);

        $object = new ArrayObject($users);
        $iterator = new UserAgeFilterIterator($object->getIterator(), 25, 40);

        while ($iterator->valid()) {
            /** @var User $user */
            $user = $iterator->current();
            echo $user->getName() . ' ' . $user->getAge() . PHP_EOL;
            $iterator->next();
        }
    }
}
