<?php
namespace PhpTranspiler\Framework\Checks;

use PhpTranspiler\Framework\Issues\PropertyNotDefinedIssue;
use PhpTranspiler\Framework\SourceElements\ClassAnalysis;

class CheckClass extends ClassAnalysis
{
    /**
     * @return PropertyNotDefinedIssue[]
     */
    public function issues()
    {
        $issues  = array();
        $methods = $this->class->methods();
        foreach ($methods as $method) {
            $issues = array_merge($issues,
                (new PropertiesDefinedCheck($this->class, $method))->issues());
        }

        return $issues;
    }
}