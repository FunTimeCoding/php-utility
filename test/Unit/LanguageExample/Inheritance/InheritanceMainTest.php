<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\Inheritance\InheritanceMain;
use PHPUnit\Framework\TestCase;

class InheritanceMainTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testMain()
    {
        $application = new InheritanceMain();
        $application->main();

        $this->expectOutputString('AnimalFood has been eaten.
CatFood has been eaten.
The cat says meow.
');
    }
}
