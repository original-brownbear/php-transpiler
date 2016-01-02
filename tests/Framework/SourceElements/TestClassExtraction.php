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
        $classes = (new ClassExtraction(
            token_get_all((new PhpSourceSanitization($source))
                ->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $classTokens = $classes['DummyClass']->toTokenArray();
        $this->assertEquals('}', end($classTokens));
        $classes = (new ClassExtraction(token_get_all(
            (new PhpSourceSanitization(
                $source . "\n" . $this->emptyClassString('AnotherDummyClass')))
                ->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $this->assertArrayHasKey('AnotherDummyClass', $classes);
    }
}