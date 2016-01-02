<?php
use PhpTranspiler\Framework\SourceFactory;
use PhpParser\PrettyPrinter;

class PhpTranspilerTestCase extends \PHPUnit_Framework_TestCase
{
    use SourceFactory;

    protected function emptyClassString($name)
    {
        return (new PrettyPrinter\Standard)->prettyPrint(array((new PhpParser\Node\Stmt\Class_($name))));
    }
}