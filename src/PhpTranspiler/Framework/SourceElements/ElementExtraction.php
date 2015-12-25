<?php
namespace PhpTranspiler\Framework\SourceElements;

abstract class ElementExtraction extends TokenArrayAnalysis
{
    protected function findEndIndex($i)
    {
        $open   = 0;
        $length = count($this->tokenArray);
        for (; $i < $length; $i++) {
            if ($this->tokenArray[$i] === '{') {
                $open++;
            } elseif ($this->tokenArray[$i] === '}') {
                $open--;
            }

            if ($open === 0) {
                break;
            }
        }

        return $i;
    }

    protected function extractCurlyBracketsContent($startIndex)
    {
        $searchOffset = $startIndex + 2;
        $start        = array_search('{',
                array_slice($this->tokenArray, $searchOffset),
                true) + $searchOffset;

        return array_slice($this->tokenArray,
            $start, $this->findEndIndex($start) - $start + 1);
    }
}