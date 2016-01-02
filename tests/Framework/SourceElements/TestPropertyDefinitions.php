<?php
use PhpParser\Node\Stmt\Class_;
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\SourceElements\PropertyDefinitions;

class PropertyDefinitionsTest extends PhpTranspilerTestCase
{
    public function testMethods()
    {
        $classes = (new ClassExtraction($this->sourceToNodes('
<?php
class DummyClass {

    private $a;
    protected $b;
    public $c;

   public function getName(){

       return $this->name;
   }
}
            ')))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $properties = (new PropertyDefinitions($classes['DummyClass']))->properties();
        $this->assertArrayHasKey('a', $properties);
        $this->assertArrayHasKey('b', $properties);
        $this->assertArrayHasKey('c', $properties);
        $this->assertEquals(Class_::MODIFIER_PRIVATE,
            $properties['a']->accessLevel());
        $this->assertEquals(Class_::MODIFIER_PROTECTED,
            $properties['b']->accessLevel());
        $this->assertEquals(Class_::MODIFIER_PUBLIC,
            $properties['c']->accessLevel());
    }
}