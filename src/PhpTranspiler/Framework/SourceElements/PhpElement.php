<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpParser\Node;
use PhpTranspiler\Framework\Base\NamedElement;

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