<?php
namespace PhpTranspiler\Framework;

use Symfony\Component\Console\Exception\InvalidArgumentException;

class SourceFile
{
    private $url;

    public function __construct($path)
    {
        if (false === is_dir($path)) {
            throw new InvalidArgumentException('Given path does not contain a file.');
        }

        $this->url = $path;
    }
}