<?php
use \PhpTranspiler\Framework\SourceElements\MethodType;
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\SourceElements\MethodExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class MethodTypeTest extends PhpTranspilerTestCase
{
    public function testType()
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
        $this->assertEquals(PHP_T_GETTER_METHOD,
            (new MethodType($methods['getName']))->type());
    }
}