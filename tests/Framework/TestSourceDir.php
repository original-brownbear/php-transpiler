<?php
use \PhpTranspiler\Framework\SourceDir;

class SourceDirTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testConstructorException()
    {
        new SourceDir('/fooo');
    }
}