<?php

namespace EmanueleMinotto\Schemer\Command\Validation;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Mozilla's contribute.json validation.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class ContributeCommand extends AbstractValidateCommand
{
    /**
     * Contribute.json schema.
     *
     * @link https://raw.githubusercontent.com/mozilla/contribute.json/master/schema.json
     * @link https://contribute.paas.allizom.org/
     */
    const SCHEMA = 'https://raw.githubusercontent.com/mozilla/contribute.json/master/schema.json';

    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('validate:contribute');
        $this->setDescription('Mozilla\'s contribute.json configuration file validation');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target contribute.json');
        $this->setAliases(['contribute:validate']);
    }

    /**
     * Schema URL.
     *
     * @return string
     */
    protected function getSchemaUrl()
    {
        return self::SCHEMA;
    }
}
