<?php
namespace PhpTranspiler\Framework;

use PhpTranspiler\Framework\SourceElements\PhpClassView;

class SourceFileView
{
    /** @var  SourceFile $source_dir */
    private $sourceFile;

    /**
     * SourceFileView constructor.
     *
     * @param SourceFile $sourceFile
     */
    public function __construct($sourceFile)
    {
        $this->sourceFile = $sourceFile;
    }

    /**
     * @return string
     */
    public function render()
    {
        $classes     = $this->sourceFile->getClasses();
        $classOutput = array();
        foreach ($classes as $class) {
            $classOutput[] = (new PhpClassView($class))->render();
        }

        return ' Analyzing ' . count($classes) . " classes in "
               . $this->sourceFile->getPath() . ":\n" . join("\n",
            $classOutput);
    }
}