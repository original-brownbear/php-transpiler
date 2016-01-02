<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpTranspiler\Framework\Base\NamedElement;
use PhpParser\Node;

abstract class PhpElement implements NamedElement
{
    /** @var  Node $node */
    protected $node;

    /**
     * PhpElement constructor.
     *
     * @param $node
     */
    public function __construct($node)
    {
        $this->node = $node;
    }

    /**
     * @return string
     */
    public function name()
    {

        return $this->node->{'name'};
    }

    /**
     * @return Node\Stmt\Class_
     */
    public function asNode()
    {

        return $this->node;
    }

}