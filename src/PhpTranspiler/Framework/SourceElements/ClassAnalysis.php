<?php

namespace PhpTranspiler\Framework\SourceElements;

abstract class ClassAnalysis
{
    /** @var  PhpClass $class */
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }
}