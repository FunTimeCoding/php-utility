<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\OpenSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchableInterface;
use PHPUnit_Framework_TestCase;

class OpenSwitchCommandTest extends PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $mock = $this->getMockBuilder('FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchableInterface')->getMock();
        $mock->expects($this->exactly(1))->method('powerOff');

        /* @var SwitchableInterface $mock */
        $command = new OpenSwitchCommand($mock);

        $command->execute();
    }
}
