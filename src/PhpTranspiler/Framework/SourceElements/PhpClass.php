<?php
namespace PhpTranspiler\Framework\SourceElements;

class PhpClass extends PhpElement
{
    /**
     * @return PhpMethod[]
     */
    public function methods()
    {
        return (new MethodExtraction($this))->methods();
    }

    public function properties()
    {
        return (new PropertyDefinitions($this))->properties();
    }
}