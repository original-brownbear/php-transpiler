<?php

namespace PhpTranspiler\Framework\SourceElements;

abstract class MethodAnalysis
{
    /** @var  PhpMethod $class */
    protected $method;

    /**
     * MethodAnalysis constructor.
     *
     * @param PhpMethod $method
     */
    public function __construct($method)
    {
        $this->method = $method;
    }
}