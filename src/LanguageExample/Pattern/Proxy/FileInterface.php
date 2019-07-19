<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Proxy;

interface FileInterface
{
    public function __construct(string $filename);

    public function getContent(): string;
}
