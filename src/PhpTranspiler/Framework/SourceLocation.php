<?php
namespace PhpTranspiler\Framework;

use Symfony\Component\Console\Exception\InvalidArgumentException;

abstract class SourceLocation
{
    protected $url;

    public function __construct($path)
    {
        $this->url = $path;
        if (false === $this->checkValidPath()) {
            throw new InvalidArgumentException($this->invalidPathMessage());
        }
    }

    abstract protected function invalidPathMessage();

    abstract protected function checkValidPath();
}