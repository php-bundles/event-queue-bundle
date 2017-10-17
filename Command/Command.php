<?php

namespace SymfonyBundles\EventQueueBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

abstract class Command extends ContainerAwareCommand
{
    /**
     * @var QueueProcess
     */
    protected $process;

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $path = $this->getContainer()->getParameter('sb_event_queue.storage_path');

        $this->process = new QueueProcess();
        $this->process->setPath($path);

        if ($input->hasOption('name')) {
            $this->process->setQueueName($input->getOption('name'));
        }
    }
}
