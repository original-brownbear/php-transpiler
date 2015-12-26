<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;
use \PhpTranspiler\Framework\SourceOutput\ClassWriter;

class ClassWriterTest extends \PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $source  = '
<?php
class DummyClass {

}
            ';
        $classes = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source))->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $class = $classes['DummyClass'];
        $this->assertEquals('class DummyClass{}',
            (new ClassWriter($class))->asString());
    }
}