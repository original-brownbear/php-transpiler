<?php
namespace PhpTranspiler\Framework\Filters\File;

use PhpTranspiler\Framework\SourceWriter;

class CommentRemovalFilter extends FileFilter
{
    use SourceWriter;

    public function run()
    {
        $source = $this->file->sourceTree();
        foreach ($source as &$node) {
            if ((bool)$node->getAttribute('comments') === true) {
                $node->setAttribute('comments', array());
            }
        }
        $this->file->setStringContent($this->nodesToSource(array_filter($source)));
    }

    /**
     * @return string[]
     */
    public function depends()
    {
        return [];
    }
}