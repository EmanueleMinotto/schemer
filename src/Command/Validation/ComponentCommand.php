<?php

namespace EmanueleMinotto\Schemer\Command\Validation;

use Symfony\Component\Console\Input\InputArgument;

/**
 * component.json validation
 */
class ComponentCommand extends AbstractValidateCommand
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
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('validate:component');
        $this->setDescription('Component.js configuration files validation');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target component.json');
        $this->setAliases(['component:validate']);
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
