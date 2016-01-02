<?php
namespace PhpTranspiler\Framework\SourceOutput;

use PhpParser\PrettyPrinter\Standard;

use PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\SourceElements\ClassAnalysis;
use PhpParser\Parser;

class ClassWriter extends ClassAnalysis
{
    /** @var Parser $parser */
    private $parser;

    public function __construct($parser, $class)
    {
        parent::__construct($class);
        $this->parser = $parser;
    }

    public function asString()
    {
        return (new PhpSourceSanitization($this->parser,
            (new Standard())->prettyPrint(array($this->class->asNode()))))->stringContent();
    }
}