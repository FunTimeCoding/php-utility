<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Adapter;

class MaleToFemaleAdapter
{
    /**
     * @param Socket $socket
     */
    public function __construct(Socket $socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return string
     */
    public function driveMale()
    {
        return $this->socket->driveFemale();
    }
}
