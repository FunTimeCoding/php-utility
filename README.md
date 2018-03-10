# PhpUtility

## Usage

This section explains how to use this project.

Run the main entry point program.

```sh
bin/pu
```


## Development

This section explains how to use scripts that are intended to ease the development of this project.

Install development tools.

```sh
composer install
```

Run code style check, metrics and tests.

```sh
script/style-check.sh
script/metrics.sh
script/test.sh
```

Build the project like Jenkins.

```sh
script/build.sh
```


## Important details

* Composer installs executable scripts in `vendor/bin/php` to leave `bin` for the actual project.
* The directories `src/LanguageExample` and `test/LanguageExample` are for sharing language specific knowledge.
