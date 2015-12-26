<?php

namespace PhpTranspiler\Framework\SourceElements;

class PropertyAccess extends MethodAnalysis
{
    public function properties()
    {
        $tokenArray = $this->method->toTokenArray();
        $properties = array();
        foreach ($tokenArray as $i => $token) {
            if ($tokenArray[$i][0] === T_VARIABLE && $tokenArray[$i][1] === '$this'
                && $tokenArray[$i + 1][0] === T_OBJECT_OPERATOR
                && $tokenArray[$i + 2][0] === T_STRING
                && ( ! isset($tokenArray[$i + 3][1]) ||
                     ($tokenArray[$i + 3][0] === T_WHITESPACE && ! isset($tokenArray[$i + 4][1])))
            ) {
                $properties[] = $tokenArray[$i + 2][1];
            }
        }

        return $properties;
    }
}