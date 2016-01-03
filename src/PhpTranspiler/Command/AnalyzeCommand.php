<?php
namespace PhpTranspiler\Command;

require_once dirname(__DIR__) . '/constants.php';
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
        $path = $this->getInputPath($input);
        $output->writeln('<info>Analyzing ' . $path . '</info>');
        $output->writeln('<info>' . (new SourceDirView($this->sourceDir($path)))->render() . '</info>');
    }
}
