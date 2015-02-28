<?php

namespace EmanueleMinotto\Schemer\Command\Format;

use Symfony\Component\Console\Input\InputArgument;

/**
 * composer.json formatting.
 */
class ComposerCommand extends AbstractFormatCommand
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
        $this->setName('format:composer');
        $this->setDescription('PHP Composer configuration file formatting');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target composer.json');
        $this->setAliases(['composer:format']);

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
