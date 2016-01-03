<?php
use PhpParser\PrettyPrinter\Standard;
use PhpParser\PrettyPrinter;
use PhpTranspiler\Framework\SourceFile;
use PhpTranspiler\Framework\SourceToNodes;
use PhpParser\Node\Stmt\Class_;

class PhpTranspilerTestCase extends \PHPUnit_Framework_TestCase
{
    use SourceToNodes;

    /**
     * @param string $name
     *
     * @return string
     */
    protected function emptyClassString($name)
    {
        return (new Standard)->prettyPrint([(new Class_($name))]);
    }

    /**
     * @param string $source
     *
     * @return SourceFile|PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockSourceFile($source = '')
    {
        $sourceFile = $this->getMockBuilder('PhpTranspiler\Framework\SourceFile')->disableOriginalConstructor()->getMock();
        $sourceFile->method('stringContent')->willReturn($source);
        if ($source) {
            $sourceFile->method('sourceTree')->willReturn($this->sourceFactory()->parser()->parse($source));
        }

        return $sourceFile;
    }
}