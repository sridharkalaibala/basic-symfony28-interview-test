<?php
namespace NeoBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Question\ConfirmationQuestion;


class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {

        $this->setName('test:command')
            ->addArgument('id', InputArgument::OPTIONAL, 'The Document Id',1)
            ->setDescription('Check given id is exist or not')
            ->setHelp('This command allows you to check given id is exist or not in the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
            $helper = $this->getHelper('question');
            $question = new ConfirmationQuestion(
                'This is a test. Do you want to continue (y/N) ?',
                false,
                '/^(y|j)/i'
            );
            if (!$helper->ask($input, $output, $question)) {
                return $output->writeln('Nothing done. Exiting...');
            }
            $id = $input->getArgument('id');
            $repository = $this->getContainer()->get('doctrine_mongodb')
                ->getManager()
                ->getRepository('NeoBundle:Feed');
            $feed = $repository->findOneById($id);
            if(isset($feed)) {
                $output->writeln('Success: document exists');
            }else {
                $output->writeln('Error: document doesn\'t exist');
            }
    }
}