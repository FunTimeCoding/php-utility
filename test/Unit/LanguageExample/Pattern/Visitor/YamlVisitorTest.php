<?php

namespace FunTimeCoding\PhpSkeleton\Test\Unit\LanguageExample\Pattern\Visitor;

use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Visitor\Node;
use FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Visitor\YamlVisitor;
use PHPUnit_Framework_TestCase;

class YamlVisitorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testValue()
    {
        $visitor = new YamlVisitor();
        $node = new Node('root');
        $node->setValue('MyValue');

        $node->accept($visitor);

        $this->expectOutputString('root: MyValue'.PHP_EOL);
    }

    /**
     * @outputBuffering enabled
     */
    public function testAddNode()
    {
        $visitor = new YamlVisitor();
        $node = new Node('root');
        $leaf = new Node('leaf');
        $node->addNode($leaf);

        $node->accept($visitor);

        $this->expectOutputString('root:'.PHP_EOL.'    leaf'.PHP_EOL);
    }
}
