<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;

class ClassExtractionTest extends PhpTranspilerTestCase
{
    /**
     * @todo: implement example token representations
     */
    public function testClasses()
    {
        $source  = "<?php\n" . $this->emptyClassString('DummyClass');
        $classes = (new ClassExtraction($this->sourceToNodes($source)))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $classes = (new ClassExtraction(
            $this->sourceToNodes(
                $source . "\n" . $this->emptyClassString('AnotherDummyClass')))
        )->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $this->assertArrayHasKey('AnotherDummyClass', $classes);
    }
}