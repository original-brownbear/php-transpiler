<?php
namespace PhpTranspiler\Framework\SourceOperations;

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
        $tokenArray = $this->class->toTokenArray();
        array_shift($tokenArray);
        array_unshift($tokenArray, ';');
        array_unshift($tokenArray,
            array(T_VARIABLE, '$' . $this->property->name()));
        array_unshift($tokenArray, array(T_WHITESPACE, ' '));
        $accessLevelStrings = array(
            T_PRIVATE   => 'private',
            T_PROTECTED => 'protected',
            T_PUBLIC    => 'public'
        );
        array_unshift($tokenArray, array(
            $this->property->accessLevel(),
            $accessLevelStrings[$this->property->accessLevel()]
        ));
        array_unshift($tokenArray, '{');

        return new PhpClass($tokenArray, $this->class->name());
    }
}