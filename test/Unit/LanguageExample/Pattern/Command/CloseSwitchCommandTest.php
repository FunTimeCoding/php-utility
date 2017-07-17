<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\CloseSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchableInterface;
use PHPUnit\Framework\TestCase;

class CloseSwitchCommandTest extends TestCase
{
    public function testExecute()
    {
        $mock = $this->getMockBuilder('FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchableInterface')->getMock();
        $mock->expects($this->exactly(1))->method('powerOn');

        /* @var SwitchableInterface $mock */
        $command = new CloseSwitchCommand($mock);

        $command->execute();
    }
}
