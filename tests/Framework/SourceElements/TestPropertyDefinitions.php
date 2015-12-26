<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\SourceElements\PropertyDefinitions;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PropertyDefinitionsTest extends \PHPUnit_Framework_TestCase
{
    public function testMethods()
    {
        $source  = '
<?php
class DummyClass {

    private $a;
    protected $b;
    public $c;

   public function getName(){

       return $this->name;
   }
}
            ';
        $classes = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source))->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $properties = (new PropertyDefinitions($classes['DummyClass']))->properties();
        $this->assertArrayHasKey('a', $properties);
        $this->assertArrayHasKey('b', $properties);
        $this->assertArrayHasKey('c', $properties);
        $this->assertEquals(T_PRIVATE, $properties['a']->accessLevel());
        $this->assertEquals(T_PROTECTED, $properties['b']->accessLevel());
        $this->assertEquals(T_PUBLIC, $properties['c']->accessLevel());
    }
}