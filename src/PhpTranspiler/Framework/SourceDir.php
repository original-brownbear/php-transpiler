<?php
namespace PhpTranspiler\Framework;

class SourceDir
{
    private $url;

    public function __construct($path)
    {
        $this->url = $path;
    }

    public function path_exists()
    {

        return is_dir($this->url);
    }
}