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
        $dir         = vfsStream::newDirectory($source_path);
        $dir->addChild(vfsStream::newFile('text.txt')->at($vfs));
        $subject = new SourceDir($dir->url());
        $this->assertCount(1, $subject->getFiles());
    }
}