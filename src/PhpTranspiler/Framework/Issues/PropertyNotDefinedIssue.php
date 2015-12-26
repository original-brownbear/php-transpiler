<?php
namespace PhpTranspiler\Framework\Issues;

use PhpTranspiler\Framework\SourceElements\PhpClass;
use PhpTranspiler\Framework\SourceElements\PhpMethod;

class PropertyNotDefinedIssue
{
    /** @var  PhpClass $class */
    private $class;
    /** @var  PhpMethod $method */
    private $method;
    /** @var  string $propertyName */
    private $propertyName;

    public function __construct($class, $method, $propertyName)
    {
        $this->class        = $class;
        $this->method       = $method;
        $this->propertyName = $propertyName;
    }

    public function toArray()
    {
        return array(
            'class'        => $this->class,
            'method'       => $this->method,
            'propertyName' => $this->propertyName
        );
    }
}