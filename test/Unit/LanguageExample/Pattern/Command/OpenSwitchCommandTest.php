<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Command;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\OpenSwitchCommand;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command\SwitchableInterface;
use PHPUnit\Framework\TestCase;

class OpenSwitchCommandTest extends TestCase
{
    /**
     * @phan-suppress PhanTypeMismatchArgument
     */
    public function testExecute(): void
    {
        $mock = $this->getMockBuilder(SwitchableInterface::class)->getMock();
        $mock->expects($this::once())->method('powerOff');

        /* @var SwitchableInterface $mock */
        $command = new OpenSwitchCommand($mock);

        $command->execute();
    }
}
