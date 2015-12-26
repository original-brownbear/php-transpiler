<?php

namespace PhpTranspiler\Framework\SourceElements;

use PhpTranspiler\Framework\Checks\CheckClass;
use PhpTranspiler\Framework\Issues\PropertyNotDefinedIssueView;

class PhpClassView extends ClassAnalysis
{
    public function render()
    {
        $methodStrings = array();
        $methods       = $this->class->methods();
        foreach ($methods as $method) {
            $methodStrings[] = (new PhpMethodView($method))->render();
        }
        $issues = (new CheckClass($this->class))->issues();
        if ((bool)$issues === true) {
            $issuesString = ":\n <error>-issues:</error>\n";
            foreach ($issues as $issue) {
                $issuesString .= (new PropertyNotDefinedIssueView($issue))->render();
            }
        } else {
            $issuesString = '';
        }

        return $this->class->name() . ":\n methods:\n"
               . join("\n", $methodStrings) . $issuesString;
    }
}