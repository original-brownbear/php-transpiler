<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\SourceElements\MethodExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class PropertyAccessTest extends \PHPUnit_Framework_TestCase
{
    public function testMethods()
    {
        $source  = '
<?php
class DummyClass {

   public function getName(){
       $this->i = 6;

       return $this->name;
   }
}
            ';
        $classes = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source))->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $methods = (new MethodExtraction($classes['DummyClass']))->methods();
        $this->assertArrayHasKey('getName', $methods);
        $methodTokens = $methods['getName']->toTokenArray();
        $this->assertEquals('}', end($methodTokens));
        $this->assertEquals(
            array('i', 'name'),
            $methods['getName']->propertyAccess()->properties());
    }
}