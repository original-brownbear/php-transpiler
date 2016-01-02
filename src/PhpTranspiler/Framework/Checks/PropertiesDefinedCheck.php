<?php
namespace PhpTranspiler\Framework\Checks;

use PhpParser\Node\Stmt\Class_;
use PhpTranspiler\Framework\Issues\PropertyNotDefinedIssue;
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;
use PhpTranspiler\Framework\SourceElements\PhpMethod;
use PhpTranspiler\Framework\SourceElements\PhpClass;
use Symfony\Component\Yaml\Parser;

class PropertiesDefinedCheck
{
    /** @var  PhpMethod $method */
    private $method;
    /** @var PhpClass $class */
    private $class;

    /**
     * PropertiesDefinedCheck constructor.
     *
     * @param PhpClass  $class
     * @param PhpMethod $method
     */
    public function __construct($class, $method)
    {
        $this->class  = $class;
        $this->method = $method;
    }

    /**
     * @return PropertyNotDefinedIssue[]
     */
    public function issues()
    {
        $classPropertiesAccessed = $this->method->propertyAccess()->properties();
        $classPropertiesDefined  = $this->class->properties();
        $issues                  = array();
        foreach ($classPropertiesAccessed as $property) {
            if ( ! isset($classPropertiesDefined[$property])) {
                $issues[] = new PropertyNotDefinedIssue($this->class,
                    $this->method,
                    new PhpClassProperty($property, Class_::MODIFIER_PUBLIC));
            }
        }

        return $issues;
    }
}