<?php
declare(strict_types=1);

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

    public function __construct(CommandInterface $closedCommand, CommandInterface $openedCommand)
    {
        $this->closedCommand = $closedCommand;
        $this->openedCommand = $openedCommand;
    }

    public function open(): void
    {
        $this->openedCommand->execute();
    }

    public function close(): void
    {
        $this->closedCommand->execute();
    }
}
