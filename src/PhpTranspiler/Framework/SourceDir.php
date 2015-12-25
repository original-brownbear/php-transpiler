<?php
namespace PhpTranspiler\Framework;

class SourceDir extends SourceLocation
{
    public function getFiles()
    {
        $handle = $this->getHandle();
        $files  = array();
        while (false !== ($entry = readdir($handle))) {
            $file_path = $this->url . '/' . $entry;
            if (is_file($file_path)) {
                $files[] = new SourceFile($file_path);
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