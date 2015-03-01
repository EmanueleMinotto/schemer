<?php

namespace EmanueleMinotto\Schemer\Command\Validation;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Abstract validation command.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
abstract class AbstractValidateCommand extends Command
{
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
        $command = $application->find('validate');
        $command->ignoreValidationErrors();

        $arguments = $input->getArguments();
        $arguments['schema'] = $this->getSchemaUrl();

        return $command->run(new ArrayInput($arguments), $output);
    }

    /**
     * Schema URL.
     *
     * @return string
     */
    abstract protected function getSchemaUrl();
}
