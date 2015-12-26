<?php

namespace PhpTranspiler\Framework\SourceElements;

class PhpClassView extends ClassAnalysis
{
    public function render()
    {

        return $this->class->name() . ':';
    }
}