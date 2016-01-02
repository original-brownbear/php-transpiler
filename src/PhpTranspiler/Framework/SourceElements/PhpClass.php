<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpParser\Node;

class PhpClass extends PhpElement
{
    /**
     * @return PhpMethod[]
     */
    public function methods()
    {
        return (new MethodExtraction($this))->methods();
    }

    /**
     * @return PhpClassProperty[]
     */
    public function properties()
    {
        return (new PropertyDefinitions($this))->properties();
    }
}