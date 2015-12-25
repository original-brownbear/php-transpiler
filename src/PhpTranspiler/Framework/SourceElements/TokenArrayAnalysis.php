<?php
namespace PhpTranspiler\Framework\SourceElements;

class TokenArrayAnalysis
{
    protected $tokenArray;

    public function __construct($tokenArray)
    {
        $this->tokenArray = $tokenArray;
    }
}