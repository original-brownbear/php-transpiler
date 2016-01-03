<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\SourceElements\MethodExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class MethodExtractionTest extends PhpTranspilerTestCase
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
        $this->assertArrayHasKey('getName', $classes['DummyClass']->methods());
    }
}