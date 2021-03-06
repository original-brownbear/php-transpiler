<?php
use \PhpTranspiler\Framework\SourceFile;
use org\bovigo\vfs\vfsStream;

class SourceFileTest extends PhpTranspilerTestCase
{
    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testConstructorException()
    {
        $this->getSubject('/fooo.php');
    }

    public function testIsPhpFile()
    {
        $source_path = '/src';
        $vfs         = vfsStream::setup($source_path);
        $file        = vfsStream::newFile('foo.php')->setContent('bar')->at($vfs);
        $this->assertFalse($this->getSubject($file->url())->isPhpFile());
        $file = vfsStream::newFile('bar.php')->setContent('<?php')->at($vfs);
        $this->assertFalse($this->getSubject($file->url())->isPhpFile());
        $file = vfsStream::newFile('bar.php')->setContent("<?php\necho 'test';")->at($vfs);
        $this->assertTrue($this->getSubject($file->url())->isPhpFile());
        $file = vfsStream::newFile('bar.txt')->setContent("<?php\necho 'test';")->at($vfs);
        $this->assertFalse($this->getSubject($file->url())->isPhpFile());
    }

    private function getSubject($path)
    {
        $sourceFactory = $this->sourceFactory();

        return new SourceFile($sourceFactory, $path);
    }
}