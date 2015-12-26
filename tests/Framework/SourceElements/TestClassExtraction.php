<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class ClassExtractionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @todo: implement example token representations
     */
    public function testClasses()
    {
        $source  = '
<?php
class DummyClass {

}
            ';
        $classes = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source))->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $this->assertEquals('}', end($classes['DummyClass']->toTokenArray()));
        $classes = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source . '
class AnotherDummyClass {


        }
        '))->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $this->assertArrayHasKey('AnotherDummyClass', $classes);
    }
}