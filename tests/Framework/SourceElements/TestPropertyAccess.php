<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\SourceElements\MethodExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PropertyAccessTest extends PhpTranspilerTestCase
{
    public function testMethods()
    {
        $classes = (new ClassExtraction($this->sourceToNodes('
<?php
class DummyClass {

   public function getName(){
       $this->i = 6;

       return $this->name;
   }
}
            ')))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $methods = (new MethodExtraction($classes['DummyClass']))->methods();
        $this->assertArrayHasKey('getName', $methods);
        $this->assertEquals(
            array('i', 'name'),
            $methods['getName']->propertyAccess()->properties());
    }
}