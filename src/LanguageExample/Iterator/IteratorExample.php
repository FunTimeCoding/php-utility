<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use ArrayObject;
use IteratorIterator;

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
        $someUser = new User('Someone');
        $someUser->setAge(21);
        $anotherUser = new User('Another');
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