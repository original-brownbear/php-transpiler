<?php
namespace PhpTranspiler\Framework;

class SourceFile extends SourceLocation
{
    public function isPhpFile()
    {

        return $this->sourceFactory
            ->isValid($this->stringContent());
    }

    public function stringContent()
    {

        return stream_get_contents($this->getHandle());
    }

    protected function invalidPathMessage()
    {
        return 'Given path does not contain a file.';
    }

    protected function checkValidPath()
    {

        return is_file($this->url);
    }

    protected function getHandle()
    {
        return fopen($this->url, 'r');
    }
}