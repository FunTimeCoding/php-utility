<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use CallbackFilterIterator;

class CallbackFilterIteratorExample
{
    public function callbackFilterIterator(): void
    {
        // Not all parameters have to be used.
        // @phan-suppress-next-line PhanUnusedClosureParameter
        $appleFilterCallback = static function ($current, $key, $iterator): bool {
            $result = false;

            if ($current === 'apple') {
                $result = true;
            }

            return $result;
        };
        $iterator = new CallbackFilterIterator(
            new ArrayIterator(['apple', 'banana', 'strawberry']),
            $appleFilterCallback
        );

        foreach ($iterator as $key => $value) {
            echo $key . ' ' . $value . PHP_EOL;
        }
    }
}
