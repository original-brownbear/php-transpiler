<?php
namespace PhpTranspiler\Framework;

use PhpTranspiler\Framework\SourceElements\ClassExtraction;

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

    public function getPath()
    {

        return $this->url;
    }

    /**
     * @return SourceElements\PhpClass[]
     */
    public function getClasses()
    {
        return (new ClassExtraction(
            token_get_all($this->stringContent())))->classes();
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