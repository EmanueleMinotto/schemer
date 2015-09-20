<?php

namespace EmanueleMinotto\Schemer\Command;

use Herrera\Phar\Update\Manager;
use Herrera\Phar\Update\Manifest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Phar updates.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class SelfUpdateCommand extends Command
{
    /**
     * Manifest (JSON) file.
     */
    const MANIFEST_FILE = 'http://emanueleminotto.github.io/schemer/manifest.json';

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('self-update');
        $this->setDescription('Updates schemer.phar to the latest version');
        $this->setAliases(['selfupdate']);
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance.
     * @param OutputInterface $output An OutputInterface instance.
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $application = $this->getApplication();
        $manifest = Manifest::loadFile(self::MANIFEST_FILE);

        $manager = new Manager($manifest);
        $manager->update($application->getVersion(), true);

        return 0;
    }
}
