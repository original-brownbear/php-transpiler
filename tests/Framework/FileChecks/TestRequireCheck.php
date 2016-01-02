<?php
use PhpTranspiler\Framework\FileChecks\RequireCheck;
use \PhpTranspiler\Framework\SourceFile;
use org\bovigo\vfs\vfsStream;


class RequireCheckTest extends PhpTranspilerTestCase
{
    public function testRequireUses()
    {
        $this->getRequireCheck();
        $this->getRequireCheck(true);
    }

    public function testRequireFix()
    {
        $classes = $this->getRequireCheck()->fix()->getClasses();
        $this->assertArrayHasKey('DummyClass', $classes);
        $this->assertArrayHasKey('Foo', $classes);

    }

    private function getRequireCheck($require_once = false)
    {
        $vfs           = vfsStream::setup('/src');
        $sourceFactory = $this->sourceFactory();
        $includedFile  = new SourceFile($sourceFactory,
            vfsStream::newFile('include.php')->setContent('
<?php
class Foo{}
        ')->at($vfs)->url());
        $parentFile    = new SourceFile($sourceFactory,
            vfsStream::newFile('parent.php')->setContent('
<?php
require' . ($require_once ? '_once' : '') . ' "include.php";

class DummyClass {
  public function test(){

    return $this->a;
  }
}
            ')->at($vfs)->url());
        $check         = new RequireCheck($parentFile);
        $includes      = $check->requireUses();
        if ($require_once) {
            $this->assertCount(0, $includes);
        } else {
            $this->assertCount(1, $includes);
            $this->assertEquals($includedFile, end($includes));
        }

        return $check;
    }
}