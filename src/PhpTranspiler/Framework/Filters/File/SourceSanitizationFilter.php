<?php
namespace PhpTranspiler\Framework\Filters\File;

use PhpTranspiler\Framework\SourceFactory;
use PhpTranspiler\Framework\PhpSourceSanitization;

class SourceSanitizationFilter extends FileFilter
{
    use SourceFactory;

    public function run()
    {
        $this->file->setStringContent(
            (new PhpSourceSanitization(
                $this->sourceFactory()->parser(),
                $this->file->stringContent()))->stringContent()
        );
    }

    public function depends()
    {
        return ['IncludeStatementFilter'];
    }
}