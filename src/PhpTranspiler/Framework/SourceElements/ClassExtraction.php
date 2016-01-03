<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;

class ClassExtraction
{
    /** @var Node[] $nodes */
    private $nodes;

    /**
     * ClassExtraction constructor.
     *
     * @param Node[] $nodes
     */
    public function __construct($nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * @return PhpClass[]
     */
    public function classes()
    {
        $classes = array();
        foreach ($this->nodes as $node) {
            if ($node->getType() === 'Stmt_Class') {
                /** @var Class_ $node */
                $classes[$node->name] = new PhpClass($node);
            }
        }

        return $classes;
    }
}