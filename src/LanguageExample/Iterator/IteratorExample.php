<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use AppendIterator;
use ArrayIterator;
use CachingIterator;
use InfiniteIterator;
use LimitIterator;
use MultipleIterator;
use RegexIterator;

class IteratorExample
{
    public function arrayIterator(): void
    {
        $iterator = new ArrayIterator(['apple', 'banana', 'strawberry']);

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
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

    public function cachingIterator(): void
    {
        $iterator = new CachingIterator(
            new ArrayIterator(['apple', 'banana', 'strawberry'])
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    public function limitInfiniteIterator(): void
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

    public function appendIterator(): void
    {
        $iterator = new AppendIterator();
        $iterator->append(new ArrayIterator(['apple', 'banana', 'strawberry']));
        $iterator->append(new ArrayIterator(['bird', 'dog', 'horse']));

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    public function regexIterator(): void
    {
        $iterator = new RegexIterator(
            new ArrayIterator(['apple', 'banana', 'strawberry']),
            '/banana/'
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }

    public function multipleIterator(): void
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

    public function iteratorApply(): void
    {
        $arrayIterator = new ArrayIterator(['apple', 'banana', 'strawberry']);

        $pickFruit = static function (ArrayIterator $iterator): bool {
            echo 'Picking: ' . $iterator->current() . PHP_EOL;

            return true;
        };

        iterator_apply($arrayIterator, $pickFruit, [$arrayIterator]);
    }

    /**
     * @return array<string>
     */
    public function iteratorToArray(): array
    {
        return iterator_to_array(new ArrayIterator(['apple', 'banana', 'strawberry']));
    }

    /**
     * @return int
     */
    public function iteratorCount(): int
    {
        return iterator_count(new ArrayIterator(['apple', 'banana', 'strawberry']));
    }
}
