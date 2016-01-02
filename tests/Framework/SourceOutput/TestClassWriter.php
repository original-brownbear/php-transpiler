<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;
use \PhpTranspiler\Framework\SourceOutput\ClassWriter;

class ClassWriterTest extends PhpTranspilerTestCase
{
    public function testAsString()
    {
        $classes = (new ClassExtraction($this->sourceToNodes('
<?php
class DummyClass {

}
            ')))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $class = $classes['DummyClass'];
        $this->assertEquals('class DummyClass{}',
            (new ClassWriter($this->sourceFactory()->parser(),
                $class))->asString());
    }
}