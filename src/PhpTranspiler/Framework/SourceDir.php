<?php
namespace PhpTranspiler\Framework;

class SourceDir extends SourceLocation
{
    public function getFiles()
    {
        $handle = $this->getHandle();
        $files  = array();
        while (false !== ($entry = readdir($handle))) {
            if (in_array($entry, array('.', '..'), true)) {
                continue;
            }
            $filePath = $this->url . '/' . $entry;
            if (is_file($filePath)) {
                $files[] = new SourceFile($this->sourceFactory, $filePath);
            } elseif (is_dir($filePath)) {
                $files = array_merge($files,
                    (new SourceDir($this->sourceFactory,
                        $filePath))->getFiles());
            }
        }

        return $files;
    }

    protected function invalidPathMessage()
    {
        return 'Given path does not contain a directory.';
    }

    protected function checkValidPath()
    {

        return is_dir($this->url);
    }

    protected function getHandle()
    {
        return opendir($this->url);
    }
}