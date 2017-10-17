<?php

namespace SymfonyBundles\EventQueueBundle\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DispatchCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('event:queue:dispatch')
            ->setDescription('Dispatches an events from queue.')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'Sets the name of the queue list.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getOption('name');
        $dispatcher = $this->getContainer()->get('sb_event_queue');

        if ($name) {
            $dispatcher->setName($name);
        }

        while ($dispatcher->count()) {
            $dispatcher->dispatch();
        }
    }
}
