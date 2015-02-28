schemer
=======

[![Build Status](https://img.shields.io/travis/EmanueleMinotto/schemer.svg?style=flat)](https://travis-ci.org/EmanueleMinotto/schemer)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/xxx.svg?style=flat)](https://insight.sensiolabs.com/projects/xxx)
[![Coverage Status](https://img.shields.io/coveralls/EmanueleMinotto/schemer.svg?style=flat)](https://coveralls.io/r/EmanueleMinotto/schemer)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/EmanueleMinotto/schemer.svg?style=flat)](https://scrutinizer-ci.com/g/EmanueleMinotto/schemer/)
[![Total Downloads](https://img.shields.io/packagist/dt/emanueleminotto/schemer.svg?style=flat)](https://packagist.org/packages/emanueleminotto/schemer)

A command line tool that helps you validating and formatting JSON configuration files.
File formatting is based on a [JSON schema](http://json-schema.org/) file.

Supported shortcuts (validation and formatting):

 * [Bower](http://bower.io/)
 * [Box 2](http://box-project.org/)
 * [Component](https://github.com/componentjs/guide)
 * [Composer](https://getcomposer.org/)
 * [JSHint](http://jshint.com/)
 * [Mozilla's contribute.json](https://contribute.paas.allizom.org/)
 * *More coming soon...*

API: [emanueleminotto.github.io/schemer](http://emanueleminotto.github.io/schemer/)

Install
-------

Install the schemer CLI tool adding `emanueleminotto/schemer` to your global composer.json or from CLI:

```
$ composer global require emanueleminotto/schemer
```

> **Attention!** Remember to add `$COMPOSER_HOME/vendor/bin` to your `$PATH` (*[ref](https://getcomposer.org/doc/03-cli.md#global)*).

## Usage

``` bash
# validation ...
$ schemer validate https://raw.githubusercontent.com/composer/composer/master/res/composer-schema.json composer.json
# ... with use shortcuts
$ schemer validate:bower bower.json

# formatting ...
$ schemer format https://raw.githubusercontent.com/composer/composer/master/res/composer-schema.json composer.json
# ... with use shortcuts
$ schemer format:bower bower.json

# schemer available commands
$ schemer list
```

## Testing

``` bash
$ vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
