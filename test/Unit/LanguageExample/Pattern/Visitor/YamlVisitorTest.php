<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Unit\LanguageExample\Pattern\Visitor;

use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor\Node;
use FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor\YamlVisitor;
use PHPUnit\Framework\TestCase;

class YamlVisitorTest extends TestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testValue(): void
    {
        $visitor = new YamlVisitor();
        $node = new Node('root');
        $node->setValue('MyValue');

        $node->accept($visitor);

        $this->expectOutputString('root: MyValue' . PHP_EOL);
    }

    /**
     * @outputBuffering enabled
     */
    public function testAddNode(): void
    {
        $visitor = new YamlVisitor();
        $node = new Node('root');
        $leaf = new Node('leaf');
        $node->addNode($leaf);

        $node->accept($visitor);

        $this->expectOutputString('root:' . PHP_EOL . '    leaf' . PHP_EOL);
    }
}
