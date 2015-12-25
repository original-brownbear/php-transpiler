<?php
namespace PhpTranspiler\Framework;

class SourceDirView
{
    /** @var  SourceDir $source_dir */
    private $source_dir;

    public function __construct($source_dir)
    {
        $this->source_dir = $source_dir;
    }

    public function render()
    {
        $files = $this->source_dir->getFiles();

        return 'Analyzing ' . count($files) . ' files';
    }
}