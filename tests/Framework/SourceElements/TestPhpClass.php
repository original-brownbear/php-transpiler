<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PhpClassTest extends \PHPUnit_Framework_TestCase
{
    public function testMethods()
    {
        $source  = '
<?php
class DummyClass {

   public function getName(){

       return $this->name;
   }
}
            ';
        $classes = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source))->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $methods = $classes['DummyClass']->methods();
        $this->assertArrayHasKey('getName', $methods);
        $tokenArray = $methods['getName']->toTokenArray();
        $this->assertEquals('}', end($tokenArray));
    }
}