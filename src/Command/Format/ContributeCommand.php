<?php

namespace EmanueleMinotto\Schemer\Command\Format;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Mozilla's contribute.json formatting.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class ContributeCommand extends AbstractFormatCommand
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
        $this->setName('format:contribute');
        $this->setDescription('Mozilla\'s contribute.json configuration file formatting');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target contribute.json');
        $this->setAliases(['contribute:format']);

        parent::configure();
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
