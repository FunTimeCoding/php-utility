<?php

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Visitor;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor\Node;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor\XmlVisitor;
use PHPUnit_Framework_TestCase;

class XmlVisitorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testValue()
    {
        $visitor = new XmlVisitor();
        $node = new Node('root');
        $node->setValue('MyValue');

        $node->accept($visitor);

        $this->expectOutputString('<root>MyValue</root>');
    }

    /**
     * @outputBuffering enabled
     */
    public function testAddNode()
    {
        $visitor = new XmlVisitor();
        $node = new Node('root');
        $leaf = new Node('leaf');
        $node->addNode($leaf);

        $node->accept($visitor);

        $this->expectOutputString('<root><leaf/></root>');
    }
}
