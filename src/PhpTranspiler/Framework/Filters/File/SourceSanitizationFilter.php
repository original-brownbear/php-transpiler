<?php
namespace PhpTranspiler\Framework\Filters\File;

use PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\SourceFactory;

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
        return ['IncludeStatementFilter', 'CommentRemovalFilter'];
    }
}