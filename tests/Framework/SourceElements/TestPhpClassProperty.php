<?php
use PhpTranspiler\Framework\SourceElements\PhpClassProperty;

class PhpClassPropertyTest extends PhpTranspilerTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructor()
    {
        new PhpClassProperty('foo', -1000);
    }
}