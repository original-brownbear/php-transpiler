<?php
namespace PhpTranspiler\Framework;

class PhpSource
{
    private $source;

    public function __construct($source)
    {
        $this->source = (new PhpSourceSanitization($source))->stringContent();
    }

    public function stringContent()
    {

        return $this->source;
    }
}