<?php

namespace PhpTranspiler\Framework\SourceElements;

use PhpParser\Node\Stmt\Property;

class PropertyDefinitions extends ClassAnalysis
{
    /**
     * @return PhpClassProperty[]
     */
    public function properties()
    {
        $nodes      = $this->class->asNode()->stmts;
        $properties = array();
        foreach ($nodes as $node) {
            if ($node->getType() === 'Stmt_Property') {
                /**
                 * @var Property $node
                 * @var string   $name
                 */
                $name              = isset($node->props['name'])
                    ? (isset($node->props['name']->name) ? $node->props['name']->name : $node->props['name'])
                    : $node->props[0]->name;
                $properties[$name] = new PhpClassProperty($name,
                    $node->type);
            }

        }

        return $properties;
    }
}