<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use PhpTranspiler\Framework\Checks\PropertiesDefinedCheck;

class PropertiesDefinedCheckTest extends PhpTranspilerTestCase
{
    public function testClasses()
    {
        $source  = '
<?php
class DummyClass {
  public function test(){

    return $this->a;
  }
}
            ';
        $classes = (new ClassExtraction($this->sourceToNodes($source)))->classes();
        $class   = $classes['DummyClass'];
        $methods = $class->methods();
        $method  = $methods['test'];
        $subject = new PropertiesDefinedCheck($class, $method);
        $issues  = $subject->issues();
        $this->assertCount(1, $issues);
        $issue      = end($issues);
        $issueArray = $issue->toArray();
        $this->assertEquals($class, $issueArray['class']);
        $this->assertEquals($method, $issueArray['method']);
        $this->assertEquals('a', $issueArray['property']->name());
    }
}