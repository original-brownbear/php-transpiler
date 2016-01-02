<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PhpClassTest extends PhpTranspilerTestCase
{
    public function testMethods()
    {
        $classes = (new ClassExtraction($this->sourceToNodes('
<?php
class DummyClass {

   public function getName(){

       return $this->name;
   }
}
            ')))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $methods = $classes['DummyClass']->methods();
        $this->assertArrayHasKey('getName', $methods);
    }
}