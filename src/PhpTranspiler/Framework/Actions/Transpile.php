<?php

namespace PhpTranspiler\Framework\Actions;

use PhpTranspiler\Framework\Filters;
use PhpTranspiler\Framework\Filters\File\FileFilter;
use PhpTranspiler\Framework\SourceDir;
use PhpTranspiler\Framework\SourceFactory;
use ReflectionClass;

class Transpile
{
    use SourceFactory;

    /** @var  SourceDir $outputDir */
    private $outputDir;

    /**
     * Transpile constructor.
     *
     * @param SourceDir $outputDir
     */
    public function __construct($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    public function run()
    {
        $files       = $this->outputDir->getFiles();
        $filterChain = $this->filterChainFile();
        foreach ($files as &$file) {
            if ($file->isPhpFile()) {
                $this->runFileFilterChain($file, $filterChain);
            }
        }
    }

    private function runFileFilterChain(&$file, $filterChain)
    {
        $filterInstances = array();
        foreach ($filterChain as $filterName) {
            $filterInstances[$filterName] = (new ReflectionClass('PhpTranspiler\Framework\Filters\File\\' . $filterName))->newInstance($file);
        }

        while ((bool)$filterInstances === true) {
            $filter = end($filterInstances);
            $this->runFileFilterStep($filter, $filterInstances);
        }
    }

    /**
     * @param FileFilter $filter
     * @param            $filterInstances
     */
    private function runFileFilterStep(&$filter, &$filterInstances)
    {
        $depends = $filter->depends();
        foreach ($depends as $dependencyName) {
            if (isset($filterInstances[$dependencyName])) {
                $requiredFilter = $filterInstances[$dependencyName];
                $this->runFileFilterStep($requiredFilter, $filterInstances);
            }
        }
        $filter->run();
        unset($filterInstances [array_search($filter, $filterInstances)]);
    }

    private function filterChainFile()
    {
        $filterChain = glob(dirname(__DIR__) . '/Filters/File/*');

        return array_filter(array_map(function ($fileName) {
            return preg_replace(array('#^FileFilter\.php$#', '#\.php$#'),
                '', basename($fileName));
        }, $filterChain));
    }
}