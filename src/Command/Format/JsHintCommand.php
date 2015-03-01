<?php

namespace EmanueleMinotto\Schemer\Command\Format;

use Symfony\Component\Console\Input\InputArgument;

/**
 * JSHint .jshintrc formatting.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class JsHintCommand extends AbstractFormatCommand
{
    /**
     * .jshintrc schema.
     *
     * @link http://json.schemastore.org/jshintrc
     * @link http://jshint.com/
     */
    const SCHEMA = 'http://json.schemastore.org/jshintrc';

    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('format:jshint');
        $this->setDescription('JSHint configuration files formatting');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target .jshintrc or jshint.json');
        $this->setAliases(['jshint:format']);

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
