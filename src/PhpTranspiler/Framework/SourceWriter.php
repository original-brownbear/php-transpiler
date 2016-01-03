<?php
namespace PhpTranspiler\Framework;

use PhpParser\Node;
use PhpParser\PrettyPrinter\Standard;

trait SourceWriter
{
    use SanitizeSource;

    /**
     * @param Node[] $nodes
     *
     * @return string
     */
    protected function nodesToSource($nodes)
    {
        return $this->sanitizeSource((new Standard)->prettyPrintFile($nodes));
    }
}