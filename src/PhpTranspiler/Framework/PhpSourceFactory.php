<?php
namespace PhpTranspiler\Framework;

use PhpParser\Parser;

class PhpSourceFactory
{
    /** @var Parser $parser */
    private $parser;

    /**
     * PhpSourceFactory constructor.
     *
     * @param Parser $parser
     */
    public function __construct($parser)
    {
        $this->parser = $parser;
    }

    /**
     * @return Parser
     */
    public function parser()
    {
        return $this->parser;
    }

    public function isValid($source)
    {
        $tokens = token_get_all($source);
        foreach ($tokens as $token) {
            if ($token[0] === T_OPEN_TAG) {
                $foundOpeningTag = true;
                break;
            }
        }

        return ! empty($foundOpeningTag);
    }
}