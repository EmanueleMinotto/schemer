<?php

namespace EmanueleMinotto\Schemer;

use Exception;
use GuzzleHttp\Client;
use JsonSchema\Validator;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Schemer utilities.
 *
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 */
class Utils
{
    /**
     * Display validation errors.
     *
     * @param Validator       $validator The json-schema validator.
     * @param OutputInterface $output    An OutputInterface instance.
     *
     * @return void
     */
    public static function displayErrors(Validator $validator, OutputInterface $output)
    {
        $table = new Table($output);

        $style = new TableStyle();
        $style->setCellHeaderFormat('<error>%s</error>');
        $style->setHorizontalBorderChar(' ');
        $style->setVerticalBorderChar(' ');
        $style->setCrossingChar(' ');

        $table->setHeaders(['Property', 'Error']);
        $table->setRows($validator->getErrors());
        $table->setStyle($style);

        $table->render();
    }

    /**
     * If the file is an URL then downloads it, else ensure the file is readable.
     *
     * @param InputInterface $input An InputInterface instance.
     *
     * @return void
     */
    public static function resolveSchemaUri(InputInterface $input)
    {
        if (!is_readable($input->getArgument('file'))) {
            throw new Exception('Schema file doesn\'t exist or is not readable.');
        }

        // schema argument must be an URL
        $schema = $input->getArgument('schema');

        $file = sys_get_temp_dir().'/tmp.json';

        (new Client())->get($schema, [
            'save_to' => $file,
        ]);

        $input->setArgument('schema', $file);
    }
}
