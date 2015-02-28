<?php

namespace EmanueleMinotto\Schemer\Command\Validation;

use Symfony\Component\Console\Input\InputArgument;

/**
 * composer.json validation.
 */
class ComposerCommand extends AbstractValidateCommand
{
    /**
     * Official Composer schema.
     *
     * @link https://github.com/composer/composer/blob/master/res/composer-schema.json
     */
    const SCHEMA = 'https://raw.githubusercontent.com/composer/composer/master/res/composer-schema.json';

    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('validate:composer');
        $this->setDescription('PHP Composer configuration file validation');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target composer.json');
        $this->setAliases(['composer:validate']);
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
