<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\CloseSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchableInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CloseSwitchCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $mock = $this->getMockBuilder(SwitchableInterface::class)->getMock();
        /* @var MockObject $mock */
        $mock->expects($this::once())->method('powerOn');

        /* @var SwitchableInterface $mock */
        $command = new CloseSwitchCommand($mock);

        $command->execute();
    }
}
