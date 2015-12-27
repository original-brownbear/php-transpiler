<?php
namespace PhpTranspiler\Framework\SourceOutput;

use PhpTranspiler\Framework\SourceElements\ClassAnalysis;

class ClassWriter extends ClassAnalysis
{
    public function asString()
    {
        $tokens = $this->class->toTokenArray();
        $output = 'class ' . $this->class->name();
        foreach ($tokens as $token) {
            $output .= (isset($token[1]) ? $token[1] : $token);
        }

        return $output;
    }
}