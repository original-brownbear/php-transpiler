<?php
use \PhpTranspiler\Framework\SourceFile;

class SourceFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testConstructorException()
    {
        new SourceFile('/fooo.php');
    }
}