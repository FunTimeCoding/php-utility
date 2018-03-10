<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor;

class Node implements NodeInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value = '';

    /**
     * @var NodeInterface[]
     */
    private $children = [];

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param VisitorInterface $visitor
     */
    public function accept(VisitorInterface $visitor)
    {
        $visitor->visit($this);
    }

    /**
     * @return NodeInterface[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param NodeInterface $element
     */
    public function addNode(NodeInterface $element)
    {
        $this->children[] = $element;
    }
}
