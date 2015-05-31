<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor;

interface VisitorInterface
{
    /**
     * @param NodeInterface $node
     */
    public function visit(NodeInterface $node);
}
