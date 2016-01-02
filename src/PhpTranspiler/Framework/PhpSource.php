<?php
namespace PhpTranspiler\Framework;

class PhpSource
{
    /** @var string $source */
    private $source;

    public function __construct($parser, $source)
    {
        $this->source = (new PhpSourceSanitization($parser,
            $source))->stringContent();
    }

    public function stringContent()
    {

        return $this->source;
    }
}