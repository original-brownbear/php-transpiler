<?php

namespace PhpTranspiler\Framework\Actions;

use PhpTranspiler\Framework\FileChecks\RequireCheck;
use PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\SourceDir;
use PhpTranspiler\Framework\SourceFactory;

class Transpile
{
    use SourceFactory;

    /** @var  SourceDir $outputDir */
    private $outputDir;

    /**
     * Transpile constructor.
     *
     * @param SourceDir $outputDir
     */
    public function __construct($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    public function run()
    {
        $files = $this->outputDir->getFiles();
        foreach ($files as &$file) {
            if ($file->isPhpFile()) {
                $file->setStringContent(($this->sanitizeSource((new RequireCheck($file))->fix()->stringContent())));
            }
        }
    }

    protected function sanitizeSource($source)
    {

        return (new PhpSourceSanitization($this->sourceFactory()->parser(),
            $source))->stringContent();
    }
}