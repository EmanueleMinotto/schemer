<?php

namespace EmanueleMinotto\Schemer\Command\Format;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Component.json formatting.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class ComponentCommand extends AbstractFormatCommand
{
    /**
     * Component schema.
     *
     * @link http://json.schemastore.org/component
     * @link https://github.com/componentjs/guide
     */
    const SCHEMA = 'http://json.schemastore.org/component';

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('format:component');
        $this->setDescription('Component.js configuration files formatting');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target component.json');
        $this->setAliases(['component:format']);

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
