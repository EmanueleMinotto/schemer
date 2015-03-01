<?php

namespace EmanueleMinotto\Schemer\Command\Format;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Abstract formatting command.
 */
abstract class AbstractFormatCommand extends Command
{
    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->addOption('backup', null, InputOption::VALUE_NONE, 'Creates a backup copy before formatting.');
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance.
     * @param OutputInterface $output An OutputInterface instance.
     *
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $application = $this->getApplication();
        $command = $application->find('format');
        $command->ignoreValidationErrors();

        $arguments = $input->getArguments();
        $arguments['schema'] = $this->getSchemaUrl();

        $arguments['--backup'] = $input->getOption('backup');
        $arguments['--json-unescaped-slashes'] = true;
        $arguments['--json-unescaped-unicode'] = true;

        return $command->run(new ArrayInput($arguments), $output);
    }

    /**
     * Schema URL.
     *
     * @return string
     */
    abstract protected function getSchemaUrl();
}
