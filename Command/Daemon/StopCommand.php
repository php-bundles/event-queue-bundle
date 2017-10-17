<?php

namespace SymfonyBundles\EventQueueBundle\Command\Daemon;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use SymfonyBundles\EventQueueBundle\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

class StopCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('event:queue:daemon:stop')
            ->setDescription('Stopping a dispatch an events from queue in background.')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'Sets the name of the queue list.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->process->kill();
    }
}
