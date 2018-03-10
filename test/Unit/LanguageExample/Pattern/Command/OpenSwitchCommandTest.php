<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\OpenSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchableInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class OpenSwitchCommandTest extends TestCase
{
    public function testExecute()
    {
        $mock = $this->getMockBuilder(SwitchableInterface::class)->getMock();
        /* @var MockObject $mock */
        $mock->expects($this->exactly(1))->method('powerOff');

        /* @var SwitchableInterface $mock */
        $command = new OpenSwitchCommand($mock);

        $command->execute();
    }
}
