<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpTranspiler\Framework\Base\NamedElement;

abstract class PhpElement extends TokenArrayAnalysis implements NamedElement
{
    /** @var  string $name */
    protected $name;

    public function __construct($tokenArray, $name)
    {
        parent::__construct($tokenArray);
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name()
    {

        return $this->name;
    }

    public function toTokenArray()
    {

        return $this->tokenArray;
    }
}