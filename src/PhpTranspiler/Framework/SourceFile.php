<?php
namespace PhpTranspiler\Framework;

use PhpTranspiler\Framework\SourceElements\ClassExtraction;

class SourceFile extends SourceLocation
{
    /**
     * @return bool true if the file contains valid PHP code
     */
    public function isPhpFile()
    {
        return preg_match('#(\.php|\.inc)$#', $this->url) === 1
               && $this->sourceFactory->isValid($this->stringContent());
    }

    /**
     * @return string content of the file
     */
    public function stringContent()
    {
        return preg_replace('#^\s+#', '',
            stream_get_contents($this->getHandle()));
    }

    /**
     * Just an fwrite wrapper, does not append but overwrites existing content
     *
     * @see fwrite
     *
     * @param string $content
     *
     * @return int number of bytes written
     */
    public function setStringContent($content)
    {
        return fwrite($this->getHandle('w+'), $content);
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
        return (new ClassExtraction($this->sourceTree()))->classes();
    }

    /**
     * @return null|\PhpParser\Node[]
     */
    public function sourceTree()
    {

        return $this->sourceFactory->parser()->parse($this->stringContent());
    }

    public function relativeFile($pathRelative)
    {

        return new SourceFile($this->sourceFactory,
            dirname($this->url) . '/' . $pathRelative);
    }

    protected function invalidPathMessage()
    {
        return 'Given path does not contain a file.';
    }

    protected function checkValidPath()
    {
        return is_file($this->url);
    }

    protected function getHandle($mode = 'r')
    {
        return fopen($this->url, $mode);
    }
}
