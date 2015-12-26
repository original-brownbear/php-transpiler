<?php
namespace PhpTranspiler\Framework;

class SourceFileView
{
    /** @var  SourceFile $source_dir */
    private $sourceFile;

    public function __construct($sourceFile)
    {
        $this->sourceFile = $sourceFile;
    }

    public function render()
    {
        $classes = $this->sourceFile->getClasses();

        return ' Analyzing ' . count($classes) . " classes in "
               . $this->sourceFile->getPath() . ":\n" . join("\n",
            array_keys($classes));
    }
}