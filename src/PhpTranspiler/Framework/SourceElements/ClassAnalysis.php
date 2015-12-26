<?php

namespace PhpTranspiler\Framework\SourceElements;

class ClassAnalysis
{
    /** @var  PhpClass $class */
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }
}