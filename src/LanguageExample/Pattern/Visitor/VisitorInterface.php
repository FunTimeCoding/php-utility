<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor;

interface VisitorInterface
{
    public function visit(NodeInterface $node): void;
}
