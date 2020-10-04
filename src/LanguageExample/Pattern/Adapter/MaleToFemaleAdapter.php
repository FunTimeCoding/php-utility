<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter;

/**
 * An adapter pattern should be pointed out by its class name.
 */
class MaleToFemaleAdapter
{
    /**
     * @var Socket
     */
    private $socket;

    /**
     * @param Socket $socket
     */
    public function __construct(Socket $socket)
    {
        $this->socket = $socket;
    }

    public function driveMale(): string
    {
        return $this->socket->driveFemale();
    }
}
