<?php
namespace PhpTranspiler\Framework;

class PhpSource
{
    private $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    public function stringContent()
    {

        return $this->source;
    }
}