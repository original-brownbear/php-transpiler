<?php
namespace PhpTranspiler\Framework\SourceElements;

class ClassExtraction extends ElementExtraction
{
    /**
     * @return PhpClass[]
     */
    public function classes()
    {
        $classes = array();

        foreach ($this->tokenArray as $i => $token) {
            if ($token[0] === T_CLASS) {
                $classes[$this->tokenArray[$i + 2][1]] = new PhpClass(
                    $this->extractCurlyBracketsContent($i));
            }
        }

        return $classes;
    }
}