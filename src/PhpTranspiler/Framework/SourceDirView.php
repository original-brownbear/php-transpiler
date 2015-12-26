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
        $out   = ' Analyzing ' . count($files) . " files\n";

        foreach ($files as $file) {
            $out .= (new SourceFileView($file))->render() . "\n";
        }

        return $out;
    }
}