<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter;

class Ratchet
{
    /**
     * @param Socket $socket
     *
     * @return string
     */
    public function driveMale(Socket $socket)
    {
        return (new MaleToFemaleAdapter($socket))->driveMale();
    }
}
