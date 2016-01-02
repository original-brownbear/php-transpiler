<?php
namespace PhpTranspiler\Framework\SourceElements;

use PhpParser\Node;

class MethodType extends MethodAnalysis
{
    public function type()
    {
        $res = PHP_T_NO_SPECIFIC_METHOD;
        if ($this->isRedundantGetter()) {
            $res = PHP_T_GETTER_METHOD;
        }

        return $res;
    }

    /**
     * @return bool
     */
    private function isRedundantGetter()
    {
        $nodes    = $this->method->asNode()->stmts;
        $lastNode = end($nodes);

        return count($nodes) === 1 && $lastNode->getType() === 'Stmt_Return' && $lastNode->expr->getType() === 'Expr_PropertyFetch';
    }
}