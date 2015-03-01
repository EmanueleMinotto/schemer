<?php

namespace EmanueleMinotto\Schemer\Test;

use EmanueleMinotto\Schemer\Utils;
use JsonSchema\Validator;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\StreamOutput;

/**
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 *
 * @coversDefaultClass \EmanueleMinotto\Schemer\Utils
 */
class UtilsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests right errors output.
     *
     * @covers ::displayErrors
     *
     * @return void
     */
    public function testDisplayErrors()
    {
        $validator = new Validator();
        $validator->addError(null, 'Foo');
        $validator->addError('subpath', 'Bar');

        $output = new StreamOutput(fopen('php://memory', 'r+'), StreamOutput::VERBOSITY_NORMAL, false);

        Utils::displayErrors($validator, $output);

        rewind($output->getStream());

        $this->assertStringEqualsFile(
            __DIR__.'/fixtures/Utils/testDisplayErrors',
            stream_get_contents($output->getStream())
        );

        fclose($output->getStream());
    }

    /**
     * Tests "file not found" exception.
     *
     * @covers ::resolveSchemaUri
     * @expectedException \Exception
     *
     * @return void
     */
    public function testResolveSchemaUriFileNotFound()
    {
        $definition = new InputDefinition([
            new InputArgument('file', InputArgument::REQUIRED),
        ]);
        $arguments = [
            'file' => __DIR__.'/'.rand(),
        ];

        Utils::resolveSchemaUri(new ArrayInput($arguments, $definition));
    }

    /**
     * Tests "wrong url" exception.
     *
     * @covers ::resolveSchemaUri
     * @expectedException \GuzzleHttp\Exception\ClientException
     *
     * @return void
     */
    public function testResolveSchemaUriWrongUrl()
    {
        $definition = new InputDefinition([
            new InputArgument('file', InputArgument::REQUIRED),
            new InputArgument('schema', InputArgument::REQUIRED),
        ]);
        $arguments = [
            'file' => __FILE__,
            'schema' => 'http://httpbin.org/status/404',
        ];

        Utils::resolveSchemaUri(new ArrayInput($arguments, $definition));
    }

    /**
     * Tests method without exceptions.
     *
     * @covers ::resolveSchemaUri
     *
     * @return void
     */
    public function testResolveSchemaUri()
    {
        $definition = new InputDefinition([
            new InputArgument('file', InputArgument::REQUIRED),
            new InputArgument('schema', InputArgument::REQUIRED),
        ]);
        $arguments = [
            'file' => __FILE__,
            'schema' => 'http://httpbin.org/status/200',
        ];

        $input = new ArrayInput($arguments, $definition);

        Utils::resolveSchemaUri($input);

        $this->assertStringEndsWith('/tmp.json', $input->getArgument('schema'));
    }
}
