# Skeleton

This document explains project skeleton conventions.


## Directories

What do those directories in this project mean?

* bin - Script entry points.
* lib - The actual project code.
* test - Unit tests for the project code.
* doc - Documentation files
* build - Build directory in which `ant` puts it's results.

You may leave some of those directories out if they don't apply to the purpose of this skeleton.
Some directories may also have different names according to language and package specifications. Those have priority over this document.


## Configs

Standardized files for every project.

* README.md - The readme explaining how to install required dependencies and brief usage examples.
* build.xml - An `ant` build.xml that runs all metrics, checks, tests and builds when invoking `ant` without any additional arguments.


## Scripts

* run-tests.sh - A wrapper script that executes the unit test suite of this project.
* run-lint-check.sh - Lint check wrapper script.
* run-code-style-check.sh - Code style check wrapper script.

The purpose of those wrapper scripts is to provide a unified name across all project skeletons.
