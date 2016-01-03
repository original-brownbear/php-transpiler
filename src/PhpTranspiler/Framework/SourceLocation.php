<?php
namespace PhpTranspiler\Framework;

use Symfony\Component\Console\Exception\InvalidArgumentException;

abstract class SourceLocation
{
    /** @var  string $url */
    protected $url;

    /**
     * @var PhpSourceFactory $sourceFactory
     */
    protected $sourceFactory;

    /**
     * SourceLocation constructor.
     *
     * @param PhpSourceFactory $sourceFactory
     * @param string           $path
     *
     * @throws InvalidArgumentException when no source element could be found at the given path.
     */
    public function __construct(&$sourceFactory, $path)
    {
        $this->url = $path;
        if (false === $this->checkValidPath()) {
            throw new InvalidArgumentException($this->invalidPathMessage() . ' Received: ' . $this->url);
        }
        $this->sourceFactory = &$sourceFactory;
    }

    /**
     * @return resource handle on the source elements underlying filesystem resource
     */
    abstract protected function getHandle();

    /**
     * @return string message describing the issue with the given path, in case the constructor needs to throw an exception
     */
    abstract protected function invalidPathMessage();

    /**
     * @return bool
     */
    abstract protected function checkValidPath();
}