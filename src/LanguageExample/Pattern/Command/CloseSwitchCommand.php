<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command;

class CloseSwitchCommand implements CommandInterface
{
    /**
     * @var SwitchableInterface
     */
    private $switchable;

    public function __construct(SwitchableInterface $switchable)
    {
        $this->switchable = $switchable;
    }

    public function execute(): void
    {
        $this->switchable->powerOn();
    }
}
