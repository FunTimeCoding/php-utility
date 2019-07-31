<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Visitor;

class XmlVisitor implements VisitorInterface
{
    public function visit(NodeInterface $node): void
    {
        $name = $node->getName();
        $value = $node->getValue();
        $children = $node->getChildren();
        $size = count($children);

        if (0 === $size) {
            if ('' === $value) {
                echo '<' . $name . '/>';
            } else {
                echo '<' . $name . '>' . $value . '</' . $name . '>';
            }
        } else {
            echo '<' . $name . '>';

            foreach ($children as $child) {
                $child->accept($this);
            }

            echo '</' . $name . '>';
        }
    }
}
