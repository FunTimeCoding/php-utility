<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Facade;

class ComputerFacade
{
    /**
     * @var Processor
     */
    private $processor;

    /**
     * @var Memory
     */
    private $memory;

    /**
     * @var Disk
     */
    private $disk;

    public function __construct()
    {
        $this->processor = new Processor();
        $this->memory = new Memory();
        $this->disk = new Disk();
    }

    public function start(): void
    {
        echo $this->disk->read();
        echo $this->memory->load();
        echo $this->processor->execute();
    }
}
