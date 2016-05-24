<?php

namespace SymfonyBundles\EventQueueBundle\Command\Daemon;

use SymfonyBundles\EventQueueBundle\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('event:queue:daemon:start')
            ->setDescription('Dispatches an events from queue in background.')
            ->addOption('name', null, InputOption::VALUE_OPTIONAL, 'Sets the name of the queue list.')
            ->addOption('delay', null, InputOption::VALUE_REQUIRED, 'The waiting time between iterations.', 0)
            ->addOption('iterations', 'i', InputOption::VALUE_REQUIRED, 'Number of iteration to exit. Default "-1" - never to be finished.', -1);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $delay = $input->getOption('delay');
        $iterations = $input->getOption('iterations');
        $dispatcher = $this->getApplication()->find('event:queue:dispatch');
        $dispatcherInput = new ArrayInput(['--name' => $input->getOption('name')]);

        $this->process->save();

        while ($this->process->has()) {
            $iterations--;

            $dispatcher->run($dispatcherInput, $output);

            sleep($delay);

            if (0 === $iterations) {
                $this->process->kill();
            }
        }
    }

}
