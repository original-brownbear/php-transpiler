<?php
namespace PhpTranspiler\Framework\SourceElements;

class PhpMethodView extends MethodAnalysis
{
    public function render()
    {

        return $this->method->name();
    }
}