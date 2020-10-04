<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Visitor;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor\Node;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testValue(): void
    {
        $node = new Node('root');

        $node->setValue('foo');

        $this::assertEquals('foo', $node->getValue());
    }

    public function testAddNode(): void
    {
        $node = new Node('root');
        $leaf = new Node('leaf');

        $node->addNode($leaf);

        $this::assertCount(1, $node->getChildren());
    }
}
