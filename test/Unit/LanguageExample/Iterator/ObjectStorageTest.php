<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Iterator;

use FunTimeCoding\PhpUtility\LanguageExample\Iterator\ObjectStorageExample;
use PHPUnit_Framework_TestCase;

class ObjectStorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testSplObjectStorage()
    {
        $example = new ObjectStorageExample();

        $example->customSplObjectStorage();

        $expected = <<<OUTPUT
Object: apple
Data: Array
(
    [0] => apple
)

Object: banana
Data: Array
(
    [0] => banana
)


OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testObjectStorage()
    {
        $example = new ObjectStorageExample();

        $example->myObjectStorage();

        $expected = <<<OUTPUT
Object: apple
Data: Array
(
    [0] => apple
)

Object: banana
Data: Array
(
    [0] => banana
)


OUTPUT;
        $this->expectOutputString($expected);
    }

    /**
     * @outputBuffering enabled
     */
    public function testSplObjectHashStorage()
    {
        $example = new ObjectStorageExample();

        $example->mySplObjectHashStorage();

        $expected = <<<OUTPUT
Object: apple
Data: Array
(
    [0] => apple
)

Object: banana
Data: Array
(
    [0] => banana
)


OUTPUT;
        $this->expectOutputString($expected);
    }
}
