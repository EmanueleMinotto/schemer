<?php

namespace EmanueleMinotto\Schemer\Command\Validation;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Box 2 box.json validation.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class BoxCommand extends AbstractValidateCommand
{
    /**
     * Official box2 schema.
     *
     * @link https://github.com/box-project/box2/blob/2.0/res/schema.json
     */
    const SCHEMA = 'https://raw.githubusercontent.com/box-project/box2/2.0/res/schema.json';

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('validate:box');
        $this->setDescription('PHP box2 configuration file validation');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target box.json');
        $this->setAliases(['box:validate']);
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
