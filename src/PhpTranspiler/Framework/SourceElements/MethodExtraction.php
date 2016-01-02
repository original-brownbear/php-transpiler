<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpParser\Node;

class MethodExtraction
{
    /** @var PhpClass $class */
    private $class;

    /** @param PhpClass $class */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @return PhpMethod[]
     */
    public function methods()
    {
        $methods = array();
        $nodes   = $this->class->asNode()->stmts;
        foreach ($nodes as $node) {
            if ($node->getType() === 'Stmt_ClassMethod') {
                /** @var Node\Stmt\ClassMethod $node */
                $methods[$node->name] = new PhpMethod($node);
            }
        }

        return $methods;
    }
}