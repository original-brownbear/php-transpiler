<?php
namespace PhpTranspiler\Framework\Filters\File;

use PhpTranspiler\Framework\SourceFactory;
use PhpTranspiler\Framework\FileChecks\RequireCheck;

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