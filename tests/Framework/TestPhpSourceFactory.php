<?php
use \PhpTranspiler\Framework\PhpSourceFactory;

class PhpSourceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testInvalidSource()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|\PhpTranspiler\Framework\SourceFile $mockSourceFile */
        $mockSourceFile = $this->getMockBuilder('\PhpTranspiler\Framework\SourceFile')->disableOriginalConstructor()->getMock();
        $mockSourceFile->method('stringContent')->willReturn('fooo');
        (new PhpSourceFactory())->phpSource($mockSourceFile);
    }

    public function testPhpSource()
    {
        /** @var PHPUnit_Framework_MockObject_MockObject|\PhpTranspiler\Framework\SourceFile $mockSourceFile */
        $mockSourceFile = $this->getMockBuilder('\PhpTranspiler\Framework\SourceFile')->disableOriginalConstructor()->getMock();
        $sourceCode     = "<?php\necho 'bar';";
        $mockSourceFile->method('stringContent')->willReturn($sourceCode);
        $sourceObject = (new PhpSourceFactory())->phpSource($mockSourceFile);
        $this->assertEquals($sourceCode, $sourceObject->stringContent());
    }
}