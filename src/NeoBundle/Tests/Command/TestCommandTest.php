<?php
namespace NeoBundle\Tests\Command;

use NeoBundle\Command\NeoCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Tester\CommandTester;

class TestCommandTest extends KernelTestCase
{
    public function testExecuteNotExist()
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $application->add(new NeoCommand());

        $command = $application->find('test:command');
        $commandTester = new CommandTester($command);
        $helper = $command->getHelper('question');
        $helper->setInputStream($this->getInputStream("Yes\n"));

        $commandTester->execute(array(
            'command'  => $command->getName(),
            // pass arguments to the helper
            'id' => 2,

            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Error: document doesn\'t exist', $output);
        // ...
    }

    public function testExecuteExiting()
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $application->add(new NeoCommand());

        $command = $application->find('test:command');
        $commandTester = new CommandTester($command);
        $helper = $command->getHelper('question');
        $helper->setInputStream($this->getInputStream("No\n"));

        $commandTester->execute(array(
            'command'  => $command->getName(),
            // pass arguments to the helper
            'id' => 2,

            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Exiting', $output);
        // ...
    }

    protected function getInputStream($input)
    {
        $stream = fopen('php://memory', 'r+', false);
        fputs($stream, $input);
        rewind($stream);

        return $stream;
    }
}
