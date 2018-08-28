# PhpUtility

## Setup

This section explains how to install and uninstall the project.

Install project dependencies.

```sh
script/setup.sh
```


## Usage

This section explains how to use the project.

Run the main program.

```sh
bin/pu
```


## Development

This section explains how to improve the project.

Configure Git on Windows before cloning. This avoids problems with Vagrant and VirtualBox.

```sh
git config --global core.autocrlf input
```

Create the development virtual machine on Linux and Darwin.

```sh
script/vagrant/create.sh
```

Create the development virtual machine on Windows.

```bat
script\vagrant\create.bat
```

Run tests, style check and metrics.

```sh
script/test.sh
script/style-check.sh
script/metrics.sh
```

Build project.

```sh
script/build.sh
```
