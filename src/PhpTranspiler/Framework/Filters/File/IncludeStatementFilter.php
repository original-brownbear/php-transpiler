<?php
namespace PhpTranspiler\Framework\Filters\File;

use PhpTranspiler\Framework\FileChecks\RequireCheck;
use PhpTranspiler\Framework\SourceFactory;

class IncludeStatementFilter extends FileFilter
{
    use SourceFactory;

    public function run()
    {
        $this->file->setStringContent(
            (new RequireCheck($this->file))->fix()->stringContent());
    }

    public function depends()
    {
        return [];
    }
}