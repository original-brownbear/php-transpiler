<?php
namespace PhpTranspiler\Framework;

class SourceDir extends SourceLocation
{
    protected function invalidPathMessage()
    {
        return 'Given path does not contain a directory.';
    }

    protected function checkValidPath()
    {

        return is_dir($this->url);
    }
}