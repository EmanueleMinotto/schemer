<?php

namespace EmanueleMinotto\Schemer\Command\Validation;

use Symfony\Component\Console\Input\InputArgument;

/**
 * JSHint .jshintrc validation.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class JsHintCommand extends AbstractValidateCommand
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
        $this->setName('validate:jshint');
        $this->setDescription('JSHint configuration files validation');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target .jshintrc or jshint.json');
        $this->setAliases(['jshint:validate']);
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
