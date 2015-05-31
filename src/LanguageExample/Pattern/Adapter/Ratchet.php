<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Adapter;

class Ratchet
{
    /**
     * @param Socket $socket
     *
     * @return string
     */
    public function driveMale(Socket $socket)
    {
        $adaptor = new MaleToFemaleAdapter($socket);

        return $adaptor->driveMale();
    }
}
