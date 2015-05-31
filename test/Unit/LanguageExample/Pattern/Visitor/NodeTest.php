<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Visitor;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor\Node;
use PHPUnit_Framework_TestCase;

class NodeTest extends PHPUnit_Framework_TestCase
{
    public function testValue()
    {
        $node = new Node('root');

        $node->setValue('foo');

        $this->assertEquals('foo', $node->getValue());
    }

    public function testAddNode()
    {
        $node = new Node('root');
        $leaf = new Node('leaf');

        $node->addNode($leaf);

        $this->assertEquals(1, count($node->getChildren()));
    }
}
