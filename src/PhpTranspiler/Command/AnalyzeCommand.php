<?php
namespace PhpTranspiler\Command;

require_once dirname(__DIR__) . '/constants.php';
use PhpTranspiler\Framework\SourceDir;
use PhpTranspiler\Framework\SourceDirView;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AnalyzeCommand
 * @package PhpTranspiler\Command
 *
 * Analyzes a given source file or directory for possible optimizations
 */
class AnalyzeCommand extends PhpTranspilerCommand
{
    protected function configure()
    {
        $this
            ->setName('analyze')
            ->setDescription('Analyze code')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'What directory or script do you want to work on?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>PHP Transpiler</info>');
        $path = $input->getArgument('path');
        $output->writeln('<info>Analyzing ' . $path . '</info>');
        $sourceFactory = $this->sourceFactory();
        $sourceDir     = new SourceDir($sourceFactory, $path);
        $output->writeln('<info>' . (new SourceDirView($sourceDir))->render() . '</info>');
    }
}
