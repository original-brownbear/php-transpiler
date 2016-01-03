<?php

use PhpTranspiler\Framework\Filters\File\CommentRemovalFilter;

class CommentRemovalFilterTest extends PhpTranspilerTestCase
{
    public function testDepends()
    {
        $file = $this->mockSourceFile();

        $this->assertEquals([], (new CommentRemovalFilter($file))->depends());
    }

    public function testRun()
    {
        $file = $this->mockSourceFile(
            '<?php /** Comment */ class Foo {}');
        $file->expects($this->once())->method('setStringContent')->with('<?php class Foo{}');
        (new CommentRemovalFilter($file))->run();
    }
}