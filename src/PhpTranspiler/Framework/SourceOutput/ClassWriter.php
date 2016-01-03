<?php
namespace PhpTranspiler\Framework\SourceOutput;

use PhpParser\Parser;
use PhpParser\PrettyPrinter\Standard;
use PhpTranspiler\Framework\SourceElements\ClassAnalysis;
use PhpTranspiler\Framework\SourceWriter;

class ClassWriter extends ClassAnalysis
{
    use SourceWriter;

    /**
     * @return string
     */
    public function asString()
    {
        return $this->sanitizeSource((new Standard())->prettyPrint(array($this->class->asNode())));
    }
}