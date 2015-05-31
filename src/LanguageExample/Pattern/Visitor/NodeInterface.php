<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Visitor;

interface NodeInterface
{
    /**
     * @param VisitorInterface $visitor
     */
    public function accept(VisitorInterface $visitor);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getValue();

    /**
     * @return NodeInterface[]
     */
    public function getChildren();
}
