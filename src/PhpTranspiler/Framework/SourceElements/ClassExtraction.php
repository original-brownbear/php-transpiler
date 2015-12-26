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
                $className           = $this->tokenArray[$i + 2][1];
                $classes[$className] = new PhpClass(
                    $this->extractCurlyBracketsContent($i), $className);
            }
        }

        return $classes;
    }
}