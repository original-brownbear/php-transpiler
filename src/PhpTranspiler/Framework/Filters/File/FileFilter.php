<?php

namespace PhpTranspiler\Framework\Filters\File;

use PhpTranspiler\Framework\SourceFile;

abstract class FileFilter
{
    /** @var  SourceFile $file */
    protected $file;

    /**
     * FileFilter constructor.
     *
     * @param SourceFile $file
     */
    public function __construct(&$file)
    {
        $this->file = &$file;
    }

    public abstract function run();

    /**
     * @return string[]
     */
    public abstract function depends();
}