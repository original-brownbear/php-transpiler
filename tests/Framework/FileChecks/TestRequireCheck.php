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
        $fixedFile = $this->getRequireCheck()->fix();
        $classes   = $fixedFile->getClasses();
        $this->assertArrayHasKey('DummyClass', $classes);
        $this->assertArrayHasKey('Foo', $classes);
        $sanitizedSource = $this->sanitizeSource($fixedFile->stringContent());
        $this->assertNotFalse(strpos($sanitizedSource, "x\n"));
        $this->assertFalse(strpos($sanitizedSource, '?>'));
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

  public function foo(){
    return "x\n";
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