<?php
namespace PhpTranspiler\Command;

require_once dirname(__DIR__) . '/constants.php';
use PhpTranspiler\Framework\Actions\Transpile;
use PhpTranspiler\Framework\PhpSourceFactory;
use PhpTranspiler\Framework\SourceDir;
use PhpTranspiler\Framework\SourceDirView;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TranspileCommand
 * @package PhpTranspiler\Command
 *
 * Analyzes a given source file or directory for possible optimizations
 * and saves and optimized Version of the code
 */
class TranspileCommand extends PhpTranspilerCommand
{
    protected function configure()
    {
        $this
            ->setName('transpile')
            ->setDescription('Transpile code')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'What directory or script do you want to work on?'
            )
            ->addArgument('output',
                InputArgument::REQUIRED,
                'Where should the result be saved?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>PHP Transpiler</info>');
        $inputPath  = $input->getArgument('path');
        $outputPath = $input->getArgument('output');
        $output->writeln('<info>Transpiling ' . $inputPath . ' to ' . $outputPath . '</info>');
        $sourceFactory = $this->sourceFactory();
        $sourceDir     = new SourceDir($sourceFactory, $inputPath);
        $sourceDir->copyTo($outputPath);
        (new Transpile(new SourceDir($sourceFactory, $outputPath)))->run();
        $output->writeln('<info>' . (new SourceDirView($sourceDir))->render() . '</info>');
        $output->writeln('<info>Now Fixing Issues</info>');
    }
}
