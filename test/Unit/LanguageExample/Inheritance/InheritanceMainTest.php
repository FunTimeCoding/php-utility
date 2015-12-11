<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample;

use FunTimeCoding\PhpUtility\LanguageExample\Inheritance\InheritanceMain;
use PHPUnit_Framework_TestCase;

class InheritanceMainTest extends PHPUnit_Framework_TestCase
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
