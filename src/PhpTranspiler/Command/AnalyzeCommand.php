<?php
namespace PhpTranspiler\Command;

use PhpTranspiler\Framework\PhpSourceFactory;
use PhpTranspiler\Framework\SourceDir;
use PhpTranspiler\Framework\SourceDirView;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyzeCommand extends Command
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
        $sourceFactory = new PhpSourceFactory();
        $sourceDir     = new SourceDir($sourceFactory, $path);
        $output->writeln('<info>' . (new SourceDirView($sourceDir))->render() . '</info>');
    }
}
