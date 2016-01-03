<?php
namespace PhpTranspiler\Framework;

class SourceDir extends SourceLocation
{
    /**
     * @return SourceFile[]
     */
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

    /**
     * @param string      $path
     * @param null|string $src
     */
    public function copyTo($path, $src = null)
    {
        $dir = $src ? opendir($src) : $this->getHandle();
        if ( ! is_dir($path)) {
            mkdir($path, 0777, true);
        }
        while (false !== ($file = readdir($dir))) {
            if ($file[0] !== '.') {
                $srcPath = ($src ? $src : $this->url) . '/' . $file;
                if (is_dir($srcPath)) {
                    $this->copyTo(
                        $path . '/' . $file,
                        $srcPath);
                } else {
                    copy($srcPath, $path . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * @return string
     */
    protected function invalidPathMessage()
    {
        return 'Given path does not contain a directory.';
    }

    /**
     * @return bool
     */
    protected function checkValidPath()
    {

        return is_dir($this->url);
    }

    /**
     * @return resource
     */
    protected function getHandle()
    {
        return opendir($this->url);
    }
}