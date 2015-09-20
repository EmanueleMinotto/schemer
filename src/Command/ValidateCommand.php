<?php

namespace EmanueleMinotto\Schemer\Command;

use EmanueleMinotto\Schemer\Utils;
use JsonSchema\Uri\UriRetriever;
use JsonSchema\Validator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generic validation command.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class ValidateCommand extends Command
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('validate');
        $this->setDescription('File validation based on a schema URI');
        $this->addArgument('schema', InputArgument::REQUIRED, 'Schema URI (file or URL).');
        $this->addArgument('file', InputArgument::REQUIRED, 'File to be validated.');
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance.
     * @param OutputInterface $output An OutputInterface instance.
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Utils::resolveSchemaUri($input);

        $schema = $input->getArgument('schema');
        $schema = (new UriRetriever())->retrieve('file://'.realpath($schema));
        $data = json_decode(file_get_contents($input->getArgument('file')));

        $validator = new Validator();
        $validator->check($data, $schema);

        if ($validator->isValid()) {
            $output->writeln('<info>The supplied JSON validates against the schema.</info>');

            return 0;
        }

        Utils::displayErrors($validator, $output);

        return 1;
    }
}
