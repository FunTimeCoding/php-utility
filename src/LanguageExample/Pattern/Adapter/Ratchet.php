<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Adapter;

class Ratchet
{
    public function driveMale(Socket $socket): string
    {
        return (new MaleToFemaleAdapter($socket))->driveMale();
    }
}
