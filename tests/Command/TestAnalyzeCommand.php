<?php
use PhpTranspiler\Command\AnalyzeCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use org\bovigo\vfs\vfsStream;

class AnalyzeCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new AnalyzeCommand());
        $source_path = '/src/sources';
        $path        = vfsStream::setup($source_path);
        $dir         = vfsStream::newDirectory($source_path);
        $dir->addChild(vfsStream::newFile('text.php')->setContent('
        <?php
        class TestClass {

            public function meh(){

                return $this->a;
            }
        }
        ')->at($path));
        $dir->addChild(vfsStream::newFile('text2.php')->setContent('
        <?php
        class TestClassTwo {
        }
        ')->at($path));
        $command       = $application->find('analyze');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'path'    => $dir->url()
        ));
        $output = $commandTester->getDisplay();
        $this->assertRegExp('/PHP/', $output);
        $this->assertRegExp('/issues/', $output);
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

    /**
     * @expectedException Symfony\Component\Console\Exception\InvalidArgumentException
     */
    public function testExecutePathDoesNotExist()
    {
        $source_path = '/src/sources';
        $vfs         = vfsStream::setup($source_path);
        $dir         = vfsStream::newDirectory($source_path);
        $dir->addChild(vfsStream::newFile('text.txt')->at($vfs));
        $application = new Application();
        $application->add(new AnalyzeCommand());

        $command       = $application->find('analyze');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
            'path'    => $dir->url() . '/foo'
        ));
    }
}
