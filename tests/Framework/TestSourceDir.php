<?php
use \PhpTranspiler\Framework\SourceDir;
use org\bovigo\vfs\vfsStream;

class SourceDirTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testConstructorException()
    {
        new SourceDir('/fooo');
    }

    public function testGetFiles()
    {
        $source_path = '/src/sources';
        $vfs         = vfsStream::setup($source_path);
        $vfs->addChild(vfsStream::newFile('text.txt'));
        $subject = new SourceDir($vfs->url());
        $this->assertCount(1, $subject->getFiles());
        $subdir_path = 'foo';
        $subdir      = vfsStream::newDirectory($subdir_path);
        $subdir->addChild(vfsStream::newFile('bar.php'));
        $vfs->addChild($subdir);
        $this->assertCount(2, $subject->getFiles());
    }
}