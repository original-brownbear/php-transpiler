<?php
use PhpTranspiler\Framework\FileChecks\RequireCheck;
use \PhpTranspiler\Framework\SourceFile;
use org\bovigo\vfs\vfsStream;


class RequireCheckTest extends PhpTranspilerTestCase
{
    public function testRequireUses()
    {
        $this->getRequireCheck();
    }

    public function testRequireFix()
    {
        $classes = $this->getRequireCheck()->fix()->getClasses();
        $this->assertArrayHasKey('DummyClass', $classes);
        $this->assertArrayHasKey('Foo', $classes);

    }

    private function getRequireCheck()
    {

        $sourceParent  = '
<?php
require "include.php";

class DummyClass {
  public function test(){

    return $this->a;
  }
}
            ';
        $sourceInclude = '
<?php
class Foo{}
        ';

        $source_path   = '/src';
        $vfs           = vfsStream::setup($source_path);
        $parentPath    = 'parent.php';
        $file          = vfsStream::newFile($parentPath)->setContent($sourceParent)->at($vfs);
        $fileIncluded  = vfsStream::newFile('include.php')->setContent($sourceInclude)->at($vfs);
        $sourceFactory = $this->sourceFactory();
        $parentFile    = new SourceFile($sourceFactory, $file->url());
        $includedFile  = new SourceFile($sourceFactory, $fileIncluded->url());
        $check         = new RequireCheck($parentFile);
        $includes      = $check->requireUses();
        $this->assertCount(1, $includes);
        $this->assertEquals($includedFile, end($includes));

        return $check;
    }
}