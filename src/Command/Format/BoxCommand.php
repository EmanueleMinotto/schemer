<?php

namespace EmanueleMinotto\Schemer\Command\Format;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Box 2 box.json formatting.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class BoxCommand extends AbstractFormatCommand
{
    /**
     * Official box2 schema.
     *
     * @link https://github.com/box-project/box2/blob/2.0/res/schema.json
     */
    const SCHEMA = 'https://raw.githubusercontent.com/box-project/box2/2.0/res/schema.json';

    /**
     * Configures the current command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('format:box');
        $this->setDescription('PHP box2 configuration file formatting');
        $this->addArgument('file', InputArgument::REQUIRED, 'Target box.json');
        $this->setAliases(['box:format']);

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
