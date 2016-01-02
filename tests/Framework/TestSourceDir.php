<?php
use org\bovigo\vfs\vfsStreamDirectory;
use \PhpTranspiler\Framework\SourceDir;
use \PhpTranspiler\Framework\PhpSourceFactory;
use org\bovigo\vfs\vfsStream;

class SourceDirTest extends PhpTranspilerTestCase
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
        $this->setupNestedStructure();
    }

    public function testCopyTo()
    {
        /**
         * @var vfsStreamDirectory $vfs
         * @var SourceDir          $orig
         */
        list($orig, $vfs) = $this->setupNestedStructure();
        $targetDir = vfsStream::newDirectory('out');
        $vfs->addChild($targetDir);
        $orig->copyTo($targetDir->url());
        $subject = $this->getSubject($targetDir->url());
        $this->assertCount(3, $subject->getFiles());
    }

    private function getSubject($path)
    {
        $sourceFactory = $this->sourceFactory();

        return new SourceDir($sourceFactory, $path);
    }

    private function setupNestedStructure()
    {
        $vfs       = vfsStream::setup('/src');
        $sourceDir = vfsStream::newDirectory('source');
        $vfs->addChild($sourceDir);
        $sourceDir->addChild(vfsStream::newFile('text.txt'));
        $subject = $this->getSubject($sourceDir->url());
        $this->assertCount(1, $subject->getFiles());
        $subdir_path = 'foo';
        $subdir      = vfsStream::newDirectory($subdir_path);
        $subdir->addChild(vfsStream::newFile('bar.php'));
        $sourceDir->addChild($subdir);
        $this->assertCount(2, $subject->getFiles());
        $subSubdir = vfsStream::newDirectory($subdir_path . '2');
        $subSubdir->addChild(vfsStream::newFile('bar2.php'));
        $sourceDir->addChild($subSubdir);
        $this->assertCount(3, $subject->getFiles());

        return array($subject, $vfs);
    }
}