<?php

namespace EmanueleMinotto\Schemer\Command;

use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Generic format command.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class FormatCommand extends Command
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('format');
        $this->setDescription('Formats file based on a schema URI');
        $this->addArgument('schema', InputArgument::REQUIRED, 'Schema URI (file or URL).');
        $this->addArgument('file', InputArgument::REQUIRED, 'File to be formatted.');
        $this->addOption('backup', null, InputOption::VALUE_NONE, 'Creates a backup copy before formatting.');
        $description = 'Double quotes will be escaped as "\u0022".';
        $this->addOption('json-hex-quot', null, InputOption::VALUE_NONE, $description);
        $description = 'Greater than will be escaped as "\u003E" and less than as "\u003C".';
        $this->addOption('json-hex-tag', null, InputOption::VALUE_NONE, $description);
        $description = 'Ampersands will be escaped as "\u0026".';
        $this->addOption('json-hex-amp', null, InputOption::VALUE_NONE, $description);
        $description = 'Single quotes will be escaped as "\u0027".';
        $this->addOption('json-hex-apos', null, InputOption::VALUE_NONE, $description);
        $description = 'Forward slashes will not be escaped as "\/".';
        $this->addOption('json-unescaped-slashes', null, InputOption::VALUE_NONE, $description);
        $description = 'Unicode characters will not be escaped as hexadecimals strings.';
        $this->addOption('json-unescaped-unicode', null, InputOption::VALUE_NONE, $description);
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance.
     * @param OutputInterface $output An OutputInterface instance.
     *
     * @throws Exception
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $application = $this->getApplication();
        $command = $application->find('validate');
        $command->ignoreValidationErrors();

        if ($command->execute($input, $output)) {
            throw new Exception('Target file must be valid.');
        }

        // Creates a backup copy before formatting
        if ($input->getOption('backup')) {
            $file = $input->getArgument('file');

            copy($file, $file.'~');
        }

        $this->format($input, $output);

        return 1;
    }

    /**
     * Formats a file based on a JSON schema.
     *
     * @param InputInterface  $input  An InputInterface instance.
     * @param OutputInterface $output An OutputInterface instance.
     */
    private function format(InputInterface $input, OutputInterface $output)
    {
        $schema = json_decode(file_get_contents($input->getArgument('schema')), true);
        $data = json_decode(file_get_contents($input->getArgument('file')), true);

        $this->sortObject($schema, $data);

        file_put_contents(
            $input->getArgument('file'),
            json_encode($data, $this->reduceOptions($input)).PHP_EOL
        );

        $output->writeln('<info>File formatted.</info>');
    }

    /**
     * Sort by the properties attribute.
     *
     * @param array $schema Schema or schema subsection.
     * @param array $data   Input data or a subsection.
     *
     * @uses \EmanueleMinotto\Schemer\Command\FormatCommand::sortArray
     */
    private function sortObject(array $schema, array &$data)
    {
        if ('object' !== $schema['type'] || !isset($schema['properties'])) {
            return;
        }

        $keys = array_keys($schema['properties']);
        $keys = array_flip($keys);

        uksort($data, function ($key, $compared) use ($keys) {
            return $keys[$key] >= $keys[$compared];
        });

        $schema['properties'] = $this->filterProperties($schema['properties'], $data);

        foreach ($schema['properties'] as $key => $value) {
            $method = sprintf('sort%s', ucfirst($value['type']));
            $this->$method($value, $data[$key]);
        }
    }

    /**
     * Filter schema properties for array and object only items.
     *
     * @param array $properties JSON schema properties.
     * @param array $data       Input array.
     *
     * @return array
     */
    private function filterProperties(array $properties, array $data)
    {
        $properties = array_filter($properties, function ($item) {
            return isset($item['type']) && is_scalar($item['type']) && in_array($item['type'], ['array', 'object']);
        });

        $keys = array_filter(array_keys($properties), function ($key) use ($data) {
            return isset($data[$key]);
        });

        return array_intersect_key($properties, array_flip($keys));
    }

    /**
     * Sort an array or use it to sort subobjects.
     *
     * @param array $schema Schema or schema subsection.
     * @param array $data   Input data or a subsection.
     */
    private function sortArray(array $schema, array &$data)
    {
        if (empty($data) || !isset($schema['items']) || !is_scalar($schema['items']['type'])) {
            return;
        }

        if ('string' === $schema['items']['type']) {
            sort($data);
        }

        if ('object' !== $schema['items']['type']) {
            return;
        }

        // it has be an object
        foreach (array_keys($data) as $key) {
            $this->sortObject($schema['items'], $data[$key]);
        }
    }

    /**
     * Gets the json_encode options as a numeric value.
     *
     * @param InputInterface $input An InputInterface instance.
     *
     * @return int
     */
    private function reduceOptions(InputInterface $input)
    {
        $value = JSON_PRETTY_PRINT;
        $options = array_filter($input->getOptions());

        $jsonOptionsKeys = array_filter(array_keys($options), function ($key) {
            return 'json-' === substr($key, 0, 5);
        });

        $options = array_intersect(array_keys($options), $jsonOptionsKeys);

        foreach ($options as $key) {
            $value |= constant(strtoupper(str_replace('-', '_', $key)));
        }

        return $value;
    }
}
