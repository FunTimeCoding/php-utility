<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Visitor;

class YamlVisitor implements VisitorInterface
{
    /**
     * @var int
     */
    private $indentation = 0;

    /**
     * @param NodeInterface $node
     */
    public function visit(NodeInterface $node)
    {
        $name = $node->getName();
        $value = $node->getValue();
        $children = $node->getChildren();
        $size = count($children);

        if (0 == $size) {
            if ('' == $value) {
                echo $this->getSpaces($this->indentation * 4).$name.PHP_EOL;
            } else {
                echo $this->getSpaces($this->indentation * 4).$name.': '.$value.PHP_EOL;
            }
        } else {
            echo $name.':'.PHP_EOL;
            $this->indentation++;

            foreach ($children as $child) {
                $child->accept($this);
            }
        }
    }

    /**
     * @param int $number
     *
     * @return string
     */
    public function getSpaces($number)
    {
        $result = '';

        for ($spaces = 0; $spaces < $number; $spaces++) {
            $result .= ' ';
        }

        return $result;
    }
}
