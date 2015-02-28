<?php

namespace EmanueleMinotto\Schemer\Command\Validation;

use Symfony\Component\Console\Input\InputArgument;

/**
 * bower.json validation
 */
class BowerCommand extends AbstractValidateCommand
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
        $this->setName('validate:bower');
        $this->setDescription('Bower configuration files validation');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target bower.json or .bower.json');
        $this->setAliases(['bower:validate']);
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
