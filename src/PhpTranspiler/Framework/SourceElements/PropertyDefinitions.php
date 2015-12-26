<?php

namespace PhpTranspiler\Framework\SourceElements;

class PropertyDefinitions extends ClassAnalysis
{
    public function properties()
    {
        $properties = array();
        $tokens     = $this->class->toTokenArray();
        foreach ($tokens as $i => $token) {
            if (in_array($tokens[$i][0], array(
                    T_PRIVATE,
                    T_PROTECTED,
                    T_PUBLIC
                )) && $tokens[$i + 2][0] === T_VARIABLE
            ) {
                $properties[str_replace('$', '',
                    $tokens[$i + 2][1])] = array('access' => $tokens[$i][0]);
            }
        }

        return $properties;
    }
}