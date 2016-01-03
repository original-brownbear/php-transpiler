<?php
namespace PhpTranspiler\Framework\Filters\File;

use PhpTranspiler\Framework\Checks\PropertiesDefinedCheck;
use PhpTranspiler\Framework\SourceElements\PhpClass;
use PhpTranspiler\Framework\SourceWriter;

class MissingPropertyDeclarationFilter extends FileFilter
{
    use SourceWriter;

    public function run()
    {
        $nodes = $this->file->sourceTree();
        foreach ($nodes as &$node) {
            if ($node->getType() === 'Stmt_Class') {
                $class   = new PhpClass($node);
                $methods = $class->methods();
                foreach ($methods as $method) {
                    $issues = (new PropertiesDefinedCheck($class,
                        $method))->issues();
                    foreach ($issues as $issue) {
                        $class = $issue->adjustedClass();
                    }
                }
            }
        }

        $this->file->setStringContent($this->nodesToSource($nodes));
    }

    public function depends()
    {
        return ['CommentRemovalFilter'];
    }
}