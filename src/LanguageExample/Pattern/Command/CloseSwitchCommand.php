<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command;

class CloseSwitchCommand implements CommandInterface
{
    /**
     * @var SwitchableInterface
     */
    private $switchable;

    /**
     * @param SwitchableInterface $switchable
     */
    public function __construct(SwitchableInterface $switchable)
    {
        $this->switchable = $switchable;
    }

    public function execute()
    {
        $this->switchable->powerOn();
    }
}
