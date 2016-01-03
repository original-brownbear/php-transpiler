<?php
namespace PhpTranspiler\Framework\SourceOperations;

use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;
use PhpTranspiler\Framework\SourceElements\ClassAnalysis;
use PhpTranspiler\Framework\SourceElements\PhpClass;
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;

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
        $node = $this->class->asNode();
        array_unshift($node->stmts, new Property($this->property->accessLevel(),
            array('name' => new PropertyProperty($this->property->name()))));

        return new PhpClass($node);
    }
}