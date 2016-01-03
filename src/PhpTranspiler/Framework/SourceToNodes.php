<?php
namespace PhpTranspiler\Framework;

use PhpParser\Node;

trait SourceToNodes
{
    use SanitizeSource;

    /**
     * @param string $source
     *
     * @return null|\PhpParser\Node[]
     */
    protected function sourceToNodes($source)
    {

        return (new PhpSourceSanitization($this->sourceFactory()->parser(),
            $source))->asNodes();
    }
}