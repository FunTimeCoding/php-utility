<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Command;

interface CommandInterface
{
    public function execute(): void;
}
