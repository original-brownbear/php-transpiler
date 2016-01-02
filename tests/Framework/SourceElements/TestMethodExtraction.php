<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\SourceElements\MethodExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class MethodExtractionTest extends PhpTranspilerTestCase
{
    /**
     * @todo: implement example token representations
     */
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
        $methods = (new MethodExtraction($classes['DummyClass']))->methods();
        $this->assertArrayHasKey('getName', $methods);
    }
}