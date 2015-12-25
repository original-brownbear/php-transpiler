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
            $file_path = $this->url . '/' . $entry;
            if (is_file($file_path)) {
                $files[] = new SourceFile($file_path);
            } elseif (is_dir($file_path)) {
                $files = array_merge($files,
                    (new SourceDir($file_path))->getFiles());
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