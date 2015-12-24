<?php
use PhpTranspiler\Command\AnalyzeCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class AnalyzeCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new AnalyzeCommand());

        $command       = $application->find('analyze');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'path'    => '/foo'
        ));
        $this->assertRegExp('/PHP/', $commandTester->getDisplay());
    }

    /**
     * @expectedException Symfony\Component\Console\Exception\RuntimeException
     */
    public function testExecuteNoPath()
    {
        $application = new Application();
        $application->add(new AnalyzeCommand());

        $command       = $application->find('analyze');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    }
}
