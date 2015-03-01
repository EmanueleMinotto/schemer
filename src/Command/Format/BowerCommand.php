<?php

namespace EmanueleMinotto\Schemer\Command\Format;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Bower.json formatting.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class BowerCommand extends AbstractFormatCommand
{
    /**
     * Bower schema.
     *
     * @link http://bower.io/
     * @link http://json.schemastore.org/bower
     */
    const SCHEMA = 'http://json.schemastore.org/bower';

    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('format:bower');
        $this->setDescription('Bower configuration files formatting');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target bower.json or .bower.json');
        $this->setAliases(['bower:format']);

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
