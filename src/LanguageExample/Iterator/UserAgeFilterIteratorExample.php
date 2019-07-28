<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;

class UserAgeFilterIteratorExample
{
    public function filterIterator(): void
    {
        $someUser = new User();
        $someUser->setName('Someone');
        $someUser->setAge(21);
        $anotherUser = new User();
        $anotherUser->setName('Another');
        $anotherUser->setAge(31);
        $iterator = new UserAgeFilterIterator(
            new ArrayIterator([$someUser, $anotherUser]),
            25,
            40
        );

        foreach ($iterator as $user) {
            /* @var User $user */
            echo $user->getName() . ' ' . $user->getAge() . PHP_EOL;
        }
    }
}
