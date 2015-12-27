<?php
use PhpTranspiler\Framework\Issues\PropertyNotDefinedIssue;
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;

class PropertyNotDefinedIssueTest extends \PHPUnit_Framework_TestCase
{
    public function testAdjustedClass()
    {
        $source        = '
<?php
class DummyClass {

  public function a(){
    $this->foo = "x";
  }
}
            ';
        $classes       = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source))->stringContent())))->classes();
        $class         = $classes['DummyClass'];
        $methods       = $class->methods();
        $method        = $methods['a'];
        $property      = new PhpClassProperty('x', T_PUBLIC);
        $subject       = new PropertyNotDefinedIssue($class,
            $method, $property);
        $adjustedClass = $subject->adjustedClass();
        $properties    = $adjustedClass->properties();
        $this->assertEquals($property, $properties['x']);
    }
}