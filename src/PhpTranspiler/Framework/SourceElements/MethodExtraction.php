<?php
namespace PhpTranspiler\Framework\SourceElements;

class MethodExtraction extends ElementExtraction
{
    /** @param PhpClass $class */
    public function __construct($class)
    {
        parent::__construct($class->toTokenArray());
    }

    public function methods()
    {
        $methods = array();

        foreach ($this->tokenArray as $i => $token) {
            if ($token[0] === T_FUNCTION) {
                $methods[$this->tokenArray[$i + 2][1]] = $this->extractCurlyBracketsContent($i);
            }
        }

        return $methods;
    }
}