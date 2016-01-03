<?php
namespace PhpTranspiler\Framework;

class SourceDirView
{
    /** @var  SourceDir $source_dir */
    private $sourceDir;

    /**
     * SourceDirView constructor.
     *
     * @param SourceDir $sourceDir
     */
    public function __construct($sourceDir)
    {
        $this->sourceDir = $sourceDir;
    }

    /**
     * @return string
     */
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