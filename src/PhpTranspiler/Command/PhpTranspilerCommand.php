<?php
namespace PhpTranspiler\Command;

require_once dirname(__DIR__) . '/constants.php';
use PhpTranspiler\Framework\SourceDir;
use PhpTranspiler\Framework\SourceFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class AnalyzeCommand
 * @package PhpTranspiler\Command
 *
 * Analyzes a given source file or directory for possible optimizations
 */
class PhpTranspilerCommand extends Command
{
    use SourceFactory;

    /**
     * @param string $path
     *
     * @return SourceDir
     */
    protected function sourceDir($path)
    {
        $sourceFactory = $this->sourceFactory();

        return new SourceDir($sourceFactory, $path);
    }

    /**
     * @param InputInterface $input
     *
     * @return mixed
     */
    protected function getInputPath($input)
    {
        return $input->getArgument('path');
    }
}
