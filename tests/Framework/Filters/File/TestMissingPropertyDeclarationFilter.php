<?php

use PhpTranspiler\Framework\Filters\File\MissingPropertyDeclarationFilter;

class MissingPropertyDeclarationFilterTest extends PhpTranspilerTestCase
{
    public function testDepends()
    {
        $file = $this->mockSourceFile();

        $this->assertEquals(['CommentRemovalFilter'],
            (new MissingPropertyDeclarationFilter($file))->depends());
    }

    public function testRun()
    {
        $file = $this->mockSourceFile(
            '<?php class Foo {public function bar(){return $this->a;}}');
        $file->expects($this->once())->method('setStringContent')->with('<?php class Foo{public $a;public function bar(){return $this->a;}}');
        (new MissingPropertyDeclarationFilter($file))->run();
    }
}