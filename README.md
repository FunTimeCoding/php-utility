# PhpUtility

## Development

This section explains how to use scripts that are intended to ease the development of this project.

Install development tools.

```sh
curl -sS https://getcomposer.org/installer | php
./composer.phar install
```

Run code style check, metrics and tests.

```sh
./run-style-check.sh
./run-metrics.sh
./run-tests.sh
```

Build the project like Jenkins.

```sh
./build.sh
```


## Important details

* Composer installs executable scripts in `vendor/bin/php` to leave `bin` for the actual project.
* The directories `src/LanguageExample` and `test/LanguageExample` are for sharing language specific knowledge.
