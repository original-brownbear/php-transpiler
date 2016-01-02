<?php
use PhpParser\PrettyPrinter\Standard;
use PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\SourceFactory;
use PhpParser\PrettyPrinter;

class PhpTranspilerTestCase extends \PHPUnit_Framework_TestCase
{
    use SourceFactory;

    protected function emptyClassString($name)
    {
        return (new Standard)->prettyPrint(array((new PhpParser\Node\Stmt\Class_($name))));
    }

    protected function sourceToNodes($source)
    {

        return (new PhpSourceSanitization($this->sourceFactory()->parser(),
            $source))->asNodes();
    }

    protected function sanitizeSource($source)
    {

        return (new PhpSourceSanitization($this->sourceFactory()->parser(),
            $source))->stringContent();
    }
}