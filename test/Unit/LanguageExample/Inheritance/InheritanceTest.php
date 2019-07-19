<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Inheritance;

use FunTimeCoding\PhpUtility\LanguageExample\Inheritance\InheritanceExample;
use PHPUnit\Framework\TestCase;

class InheritanceTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testInherit(): void
    {
        $application = new InheritanceExample();
        $application->inherit();

        $this->expectOutputString('AnimalFood has been eaten.
CatFood has been eaten.
The cat says meow.
');
    }
}
