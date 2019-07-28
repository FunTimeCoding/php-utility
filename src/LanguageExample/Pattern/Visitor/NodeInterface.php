<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor;

interface NodeInterface
{
    public function accept(VisitorInterface $visitor): void;

    public function getName(): string;

    public function getValue(): string;

    /**
     * @return NodeInterface[]
     */
    public function getChildren(): array;
}
