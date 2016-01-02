<?php
namespace PhpTranspiler\Framework;

use PhpParser\ParserFactory;

trait SourceFactory
{
    protected function sourceFactory()
    {
        return new PhpSourceFactory((new ParserFactory)->create(ParserFactory::PREFER_PHP5));
    }
}