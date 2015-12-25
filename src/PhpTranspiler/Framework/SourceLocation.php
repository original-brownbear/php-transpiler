<?php
namespace PhpTranspiler\Framework;

use Symfony\Component\Console\Exception\InvalidArgumentException;

abstract class SourceLocation
{
    protected $url;

    /**
     * @var PhpSourceFactory $sourceFactory
     */
    protected $sourceFactory;

    public function __construct(&$sourceFactory, $path)
    {
        $this->url = $path;
        if (false === $this->checkValidPath()) {
            throw new InvalidArgumentException($this->invalidPathMessage());
        }
        $this->sourceFactory = &$sourceFactory;
    }

    abstract protected function getHandle();

    abstract protected function invalidPathMessage();

    abstract protected function checkValidPath();
}