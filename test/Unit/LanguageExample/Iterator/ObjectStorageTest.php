<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Iterator;

use FunTimeCoding\PhpUtility\LanguageExample\Iterator\ObjectStorageExample;
use PHPUnit\Framework\TestCase;

class ObjectStorageTest extends TestCase
{
    /**
     * TODO: This should probably not output different objects than in the other tests.
     * @outputBuffering enabled
     */
    public function testSplObjectStorage(): void
    {
        $example = new ObjectStorageExample();

        $example->customSplObjectStorage();

        $expected = <<<OUTPUT
Object: FunTimeCoding\PhpUtility\LanguageExample\Iterator\CustomStorageObject Object
(
    [name] => apple
)

Data: Array
(
    [0] => apple
)

Object: FunTimeCoding\PhpUtility\LanguageExample\Iterator\CustomStorageObject Object
(
    [name] => banana
)

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
    public function testObjectStorage(): void
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
    public function testSplObjectHashStorage(): void
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
