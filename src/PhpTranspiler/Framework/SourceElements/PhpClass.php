<?php
namespace PhpTranspiler\Framework\SourceElements;

class PhpClass extends TokenArrayAnalysis
{
    public function toTokenArray()
    {

        return $this->tokenArray;
    }

    public function methods()
    {
        return (new MethodExtraction($this))->methods();
    }
}