<?php
use PhpParser\Node\Stmt\Class_;
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;
use PhpTranspiler\Framework\SourceOperations\AddClassProperty;

class AddClassPropertyTest extends PhpTranspilerTestCase
{
    public function testAdjustedClass()
    {
        $classes = (new ClassExtraction($this->sourceToNodes('
<?php
class DummyClass {
}
            ')))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $propertyName = 'foo';
        $accessLevel  = Class_::MODIFIER_PUBLIC;
        $subject      = new AddClassProperty($classes['DummyClass'],
            new PhpClassProperty($propertyName, $accessLevel));
        $properties   = $subject->adjustedClass()->properties();
        $this->assertArrayHasKey($propertyName, $properties);
        $property = $properties[$propertyName];
        $this->assertEquals($propertyName, $property->name());
        $this->assertEquals($accessLevel, $property->accessLevel());
    }
}