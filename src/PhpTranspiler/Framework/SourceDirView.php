<?php
namespace PhpTranspiler\Framework;

class SourceDirView
{
    /** @var  SourceDir $source_dir */
    private $sourceDir;

    public function __construct($sourceDir)
    {
        $this->sourceDir = $sourceDir;
    }

    public function render()
    {
        $files = $this->sourceDir->getFiles();

        return 'Analyzing ' . count($files) . ' files';
    }
}