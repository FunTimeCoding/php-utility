<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command;

class SwitchInvoker
{
    /**
     * @var CommandInterface
     */
    private $closedCommand;

    /**
     * @var CommandInterface
     */
    private $openedCommand;

    /**
     * @param CommandInterface $closedCommand
     * @param CommandInterface $openedCommand
     */
    public function __construct(CommandInterface $closedCommand, CommandInterface $openedCommand)
    {
        $this->closedCommand = $closedCommand;
        $this->openedCommand = $openedCommand;
    }

    public function open()
    {
        $this->openedCommand->execute();
    }

    public function close()
    {
        $this->closedCommand->execute();
    }
}
