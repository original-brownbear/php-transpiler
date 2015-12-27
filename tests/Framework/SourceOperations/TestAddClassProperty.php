<?php
use \PhpTranspiler\Framework\SourceElements\ClassExtraction;
use \PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;
use PhpTranspiler\Framework\SourceOperations\AddClassProperty;

class AddClassPropertyTest extends \PHPUnit_Framework_TestCase
{
    public function testAdjustedClass()
    {
        $source  = '
<?php
class DummyClass {
}
            ';
        $classes = (new ClassExtraction(token_get_all((new PhpSourceSanitization($source))->stringContent())))->classes();
        $this->assertArrayHasKey('DummyClass', $classes);
        $propertyName = 'foo';
        $accessLevel  = T_PUBLIC;
        $subject      = new AddClassProperty($classes['DummyClass'],
            new PhpClassProperty($propertyName, $accessLevel));
        $newClass     = $subject->adjustedClass();
        $properties   = $newClass->properties();
        $this->assertArrayHasKey($propertyName, $properties);
        $property = $properties[$propertyName];
        $this->assertEquals($propertyName, $property->name());
        $this->assertEquals($accessLevel, $property->accessLevel());
    }
}