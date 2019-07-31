<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\CloseSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchableInterface;
use PHPUnit\Framework\TestCase;

class CloseSwitchCommandTest extends TestCase
{
    /**
     * TODO: Remove PhanAccessMethodInternal once InvocationMocker is not declared internal anymore or otherwise.
     * @phan-suppress PhanAccessMethodInternal, PhanTypeMismatchArgument
     */
    public function testExecute(): void
    {
        $mock = $this->getMockBuilder(SwitchableInterface::class)->getMock();
        /* @var \PHPUnit\Framework\MockObject\MockObject $mock */
        $mock->expects($this::once())->method('powerOn');

        /* @var SwitchableInterface $mock */
        $command = new CloseSwitchCommand($mock);

        $command->execute();
    }
}
