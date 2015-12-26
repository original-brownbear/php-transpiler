<?php
namespace PhpTranspiler\Framework\SourceElements;

class PhpClass extends TokenArrayAnalysis
{
    /** @var  string $name */
    private $name;

    public function __construct($tokenArray, $name)
    {
        parent::__construct($tokenArray);
        $this->name = $name;
    }

    public function name()
    {

        return $this->name;
    }

    public function toTokenArray()
    {

        return $this->tokenArray;
    }

    public function methods()
    {
        return (new MethodExtraction($this))->methods();
    }
}