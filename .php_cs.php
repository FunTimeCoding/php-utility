<?php

// The vendor directory is excluded by default.
$finder = PhpCsFixer\Finder::create()
    ->exclude('build')
    ->in(__DIR__);

// Uncomment to show files selected by the finder.
//foreach ($finder as $file) {
//    echo $file.PHP_EOL;
//}

// TODO: Is it useful to disable the cache?
return PhpCsFixer\Config::create()
    ->setUsingCache(false)
    ->setRules(
        array(
            '@PSR2' => true,
            //'strict_param' => true,
            'array_syntax' => array('syntax' => 'short'),
        )
    )
    ->setFinder($finder);
