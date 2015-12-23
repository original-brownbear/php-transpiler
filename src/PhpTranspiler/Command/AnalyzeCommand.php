<?php
namespace PhpTranspiler\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class AnalyzeCommand extends Command
{
	protected function configure()
	{
		$this
			->setName('analyze')
			->setDescription('Analyze code')
			;
	}
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('PHP Transpiler');
	}
}
