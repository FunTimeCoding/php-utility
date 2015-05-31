<?php

$finder = Symfony\CS\Finder\DefaultFinder::create(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->exclude('vendor')
    ->exclude('build')
    ->in(__DIR__);

return Symfony\CS\Config\Config::create()
    ->fixers(array('-psr0'))
    ->finder($finder);
