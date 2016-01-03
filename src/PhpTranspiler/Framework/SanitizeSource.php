<?php
namespace PhpTranspiler\Framework;

trait SanitizeSource
{
    use SourceFactory;

    /**
     * @param string $source
     *
     * @return string
     */
    protected function sanitizeSource($source)
    {

        return (new PhpSourceSanitization($this->sourceFactory()->parser(),
            $source))->stringContent();
    }
}