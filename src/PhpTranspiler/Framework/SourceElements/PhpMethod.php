<?php
namespace PhpTranspiler\Framework\SourceElements;

class PhpMethod extends PhpElement
{
    public function propertyAccess()
    {
        return new PropertyAccess($this);
    }
}