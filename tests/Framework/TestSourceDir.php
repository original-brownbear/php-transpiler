<?php
use \PhpTranspiler\Framework\SourceDir;
use \PhpTranspiler\Framework\PhpSourceFactory;
use org\bovigo\vfs\vfsStream;

class SourceDirTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testConstructorException()
    {
        $this->getSubject('/fooo');
    }

    public function testGetFiles()
    {
        $source_path = '/src/sources';
        $vfs         = vfsStream::setup($source_path);
        $vfs->addChild(vfsStream::newFile('text.txt'));
        $subject = $this->getSubject($vfs->url());
        $this->assertCount(1, $subject->getFiles());
        $subdir_path = 'foo';
        $subdir      = vfsStream::newDirectory($subdir_path);
        $subdir->addChild(vfsStream::newFile('bar.php'));
        $vfs->addChild($subdir);
        $this->assertCount(2, $subject->getFiles());
    }

    private function getSubject($path)
    {
        $sourceFactory = new PhpSourceFactory();

        return new SourceDir($sourceFactory, $path);
    }
}