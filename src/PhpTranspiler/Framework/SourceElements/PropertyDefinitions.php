<?php

namespace PhpTranspiler\Framework\SourceElements;

class PropertyDefinitions extends TokenArrayAnalysis
{
    public function properties()
    {
        $properties = array();
        foreach ($this->tokenArray as $i => $token) {
            if (in_array($this->tokenArray[$i][0], array(
                    T_PRIVATE,
                    T_PROTECTED,
                    T_PUBLIC
                )) && $this->tokenArray[$i + 2][0] === T_VARIABLE
            ) {
                $properties[str_replace('$', '',
                    $this->tokenArray[$i + 2][1])] = array('access' => $this->tokenArray[$i][0]);
            }
        }

        return $properties;
    }
}