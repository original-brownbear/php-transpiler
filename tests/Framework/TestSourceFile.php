<?php
use \PhpTranspiler\Framework\SourceFile;
use org\bovigo\vfs\vfsStream;

class SourceFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testConstructorException()
    {
        new SourceFile('/fooo.php');
    }

    public function testIsPhpFile()
    {
        $source_path = '/src';
        $vfs         = vfsStream::setup($source_path);
        $file        = vfsStream::newFile('foo.php')->setContent('bar')->at($vfs);
        $this->assertFalse((new SourceFile($file->url()))->isPhpFile());
        $file = vfsStream::newFile('bar.php')->setContent('<?php')->at($vfs);
        $this->assertFalse((new SourceFile($file->url()))->isPhpFile());
        $file = vfsStream::newFile('bar.php')->setContent("<?php\necho 'test';")->at($vfs);
        $this->assertTrue((new SourceFile($file->url()))->isPhpFile());
    }
}