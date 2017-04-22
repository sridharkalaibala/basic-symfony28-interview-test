<?php
namespace NeoBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class NeoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "app/console")
            ->setName('app:download')

            // configure an argument
            ->addArgument('days', InputArgument::OPTIONAL, 'The number of days.', 3)

            // the short description shown while running "php app/console list"
            ->setDescription('Download N days of NEO Data. Default 3 days')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to download NEO data from NASA api')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $days = (int) $input->getArgument('days');
        $date = new \DateTime();
        $end_date = $date->format('Y-m-d');
        $date->modify('-'.$days.' days');
        $start_date = $date->format('Y-m-d');
        $count =  $this->getContainer()->get('download')->getDataInDays($start_date,$end_date);
        $output->writeln(['','Total Count:'.$count,'','(From:'.$start_date.' To:'.$end_date.') - '.$days.' days','']);

    }
}