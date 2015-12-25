<?php

namespace PhpTranspiler\Framework\SourceElements;

class PropertyAccess extends TokenArrayAnalysis
{
    public function properties()
    {
        $properties = array();
        foreach ($this->tokenArray as $i => $token) {
            if ($this->tokenArray[$i][0] === T_VARIABLE && $this->tokenArray[$i][1] === '$this'
                && $this->tokenArray[$i + 1][0] === T_OBJECT_OPERATOR
                && $this->tokenArray[$i + 2][0] === T_STRING
                && ( ! isset($this->tokenArray[$i + 3][1]) ||
                     ($this->tokenArray[$i + 3][0] === T_WHITESPACE && ! isset($this->tokenArray[$i + 4][1])))
            ) {
                $properties[] = $this->tokenArray[$i + 2][1];
            }
        }

        return $properties;
    }
}