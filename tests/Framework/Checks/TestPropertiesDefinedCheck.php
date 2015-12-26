<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\Checks\PropertiesDefinedCheck;

class PropertiesDefinedCheckTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @todo: implement example token representations
     */
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
        $classes = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source))->stringContent())))->classes();
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
        $this->assertEquals('a', $issueArray['propertyName']);
    }
}