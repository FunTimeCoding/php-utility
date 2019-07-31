<?php
declare(strict_types=1);

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

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function accept(VisitorInterface $visitor): void
    {
        $visitor->visit($this);
    }

    /**
     * @return NodeInterface[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function addNode(NodeInterface $element): void
    {
        $this->children[] = $element;
    }
}
