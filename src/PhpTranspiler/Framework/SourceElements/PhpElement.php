<?php
namespace PhpTranspiler\Framework\SourceElements;

class PhpElement extends TokenArrayAnalysis
{
    /** @var  string $name */
    protected $name;

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
}