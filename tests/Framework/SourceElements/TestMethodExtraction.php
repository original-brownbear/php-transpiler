<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\SourceElements\MethodExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class MethodExtractionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @todo: implement example token representations
     */
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
        $methods = (new MethodExtraction($classes['DummyClass']))->methods();
        $this->assertArrayHasKey('getName', $methods);
        $this->assertEquals('}', end($methods['getName']));
    }
}