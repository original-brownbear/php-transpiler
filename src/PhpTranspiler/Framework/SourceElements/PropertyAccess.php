<?php

namespace PhpTranspiler\Framework\SourceElements;

use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Stmt\Return_;

class PropertyAccess extends MethodAnalysis
{
    public function properties()
    {
        $nodes      = $this->method->asNode()->stmts;
        $properties = array();
        foreach ($nodes as $node) {
            if ($node->getType() === 'Stmt_Return') {
                /** @var Return_ $node */
                if (($ret = $node->expr) && $node->expr->getType() === 'Expr_PropertyFetch') {
                    /** @var PropertyFetch $ret */
                    $properties[] = $ret->name;
                }
            } elseif ($node->getType() === 'Expr_Assign') {
                /** @var Assign $node */
                if (($ret = $node->var) && $node->var->getType() === 'Expr_PropertyFetch') {
                    /** @var PropertyFetch $ret */
                    $properties[] = $ret->name;
                }
            }
        }

        return $properties;
    }
}