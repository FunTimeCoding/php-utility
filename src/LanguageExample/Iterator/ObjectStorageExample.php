<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use Iterator;

class ObjectStorageExample
{
    public function customSplObjectStorage()
    {
        $iterator = new CustomSplObjectStorage();
        $this->populateIterator($iterator);
        $this->printIterator($iterator);
    }

    public function myObjectStorage()
    {
        $appleKey = new CustomStorageObject();
        $appleKey->name = 'apple';
        $appleValue = ['apple'];

        $bananaKey = new CustomStorageObject();
        $bananaKey->name = 'banana';
        $bananaValue = ['banana'];

        $iterator = new MyObjectStorage([$appleKey, $bananaKey], [$appleValue, $bananaValue]);
        $this->printIterator($iterator);
    }

    public function mySplObjectHashStorage()
    {
        $iterator = new MySplObjectHashStorage();
        $this->populateIterator($iterator);
        $this->printIterator($iterator);
    }

    /**
     * @param Attachable $iterator
     */
    public function populateIterator(Attachable $iterator)
    {
        $appleKey = new CustomStorageObject();
        $appleKey->name = 'apple';
        $appleValue = ['apple'];
        $iterator->attach($appleKey, $appleValue);

        $bananaKey = new CustomStorageObject();
        $bananaKey->name = 'banana';
        $bananaValue = ['banana'];
        $iterator->attach($bananaKey, $bananaValue);
    }

    /**
     * @param Iterator $iterator
     */
    public function printIterator(Iterator $iterator)
    {
        foreach ($iterator as $key => $value) {
            echo 'Object: '.print_r($key, true).PHP_EOL;
            echo 'Data: '.print_r($value, true).PHP_EOL;
        }
    }
}
