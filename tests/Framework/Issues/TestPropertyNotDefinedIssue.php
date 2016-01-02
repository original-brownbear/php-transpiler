<?php
use PhpParser\Node\Stmt\Class_;
use PhpTranspiler\Framework\Issues\PropertyNotDefinedIssue;
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;

class PropertyNotDefinedIssueTest extends PhpTranspilerTestCase
{
    public function testAdjustedClass()
    {
        $classes       = (new ClassExtraction($this->sourceToNodes('
<?php
class DummyClass {

  public function a(){
    $this->foo = "x";
  }
}
            ')))->classes();
        $class         = $classes['DummyClass'];
        $methods       = $class->methods();
        $method        = $methods['a'];
        $property      = new PhpClassProperty('x', Class_::MODIFIER_PUBLIC);
        $subject       = new PropertyNotDefinedIssue($class,
            $method, $property);
        $adjustedClass = $subject->adjustedClass();
        $properties    = $adjustedClass->properties();
        $this->assertEquals($property, $properties['x']);
    }
}