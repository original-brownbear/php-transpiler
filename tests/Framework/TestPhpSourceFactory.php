<?php

class PhpSourceFactoryTest extends PhpTranspilerTestCase
{
    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testInvalidSource()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|\PhpTranspiler\Framework\SourceFile $mockSourceFile */
        $mockSourceFile = $this->getMockBuilder('\PhpTranspiler\Framework\SourceFile')->disableOriginalConstructor()->getMock();
        $mockSourceFile->method('stringContent')->willReturn('fooo');
        $this->sourceFactory()->phpSource($mockSourceFile);
    }

    public function testPhpSource()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|\PhpTranspiler\Framework\SourceFile $mockSourceFile */
        $mockSourceFile      = $this->getMockBuilder('\PhpTranspiler\Framework\SourceFile')->disableOriginalConstructor()->getMock();
        $sourceCode          = "<?php\necho 'bar';";
        $sourceCodeSanitized = "<?php echo 'bar';";
        $mockSourceFile->method('stringContent')->willReturn($sourceCode);
        $sourceObject = $this->sourceFactory()->phpSource($mockSourceFile);
        $this->assertEquals($sourceCodeSanitized,
            $sourceObject->stringContent());
    }
}