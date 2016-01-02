<?php
namespace PhpTranspiler\Framework\SourceOperations;

use PhpTranspiler\Framework\SourceElements\ClassAnalysis;
use PhpTranspiler\Framework\SourceElements\PhpClass;
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;
use PhpParser\Node\Stmt\Property;

class AddClassProperty extends ClassAnalysis
{
    /** @var  PhpClassProperty $property */
    private $property;

    /**
     * AddClassProperty constructor.
     *
     * @param PhpClass         $class
     * @param PhpClassProperty $property
     */
    public function __construct($class, $property)
    {
        parent::__construct($class);
        $this->property = $property;
    }

    /**
     * @return PhpClass
     */
    public function adjustedClass()
    {
        $node          = $this->class->asNode();
        $node->stmts[] = new Property($this->property->accessLevel(),
            array('name' => $this->property->name()));

        return new PhpClass($node);
    }
}