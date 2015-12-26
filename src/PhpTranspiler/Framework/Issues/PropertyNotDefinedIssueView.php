<?php
namespace PhpTranspiler\Framework\Issues;

class PropertyNotDefinedIssueView
{
    private $issue;

    /**
     * PropertyNotDefinedIssueView constructor.
     *
     * @param PropertyNotDefinedIssue $issue
     */
    public function __construct($issue)
    {
        $this->issue = $issue;
    }

    public function render()
    {
        $data = $this->issue->toArray();

        return "- <error> Undefined property " . $data['property']->name()
               . ' is accessed by method ' . $data['method']->name() .
               'of class ' . $data['class']->name()
               . "</error>\n";
    }
}