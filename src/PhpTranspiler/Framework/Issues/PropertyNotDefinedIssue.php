<?php
namespace PhpTranspiler\Framework\Issues;

use PhpTranspiler\Framework\SourceElements\PhpClass;
use PhpTranspiler\Framework\Base\NamedElement;
use PhpTranspiler\Framework\SourceElements\PhpMethod;
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;

class PropertyNotDefinedIssue
{
    /** @var  PhpClass $class */
    private $class;
    /** @var  PhpMethod $method */
    private $method;
    /** @var  PhpClassProperty $property */
    private $property;

    public function __construct($class, $method, $property)
    {
        $this->class    = $class;
        $this->method   = $method;
        $this->property = $property;
    }

    /**
     * @return NamedElement[]
     */
    public function toArray()
    {
        return array(
            'class'    => $this->class,
            'method'   => $this->method,
            'property' => $this->property
        );
    }
}