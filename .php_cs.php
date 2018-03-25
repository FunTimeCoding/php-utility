<?php

// The vendor directory is excluded by default.
$finder = PhpCsFixer\Finder::create()
    ->exclude('build')
    ->in(__DIR__);

// Uncomment for debugging to show files selected by the finder.
//foreach ($finder as $file) {
//    echo $file.PHP_EOL;
//}

return PhpCsFixer\Config::create()
    ->setRules(
        array(
            '@PSR2' => true,
            //'strict_param' => true,
            'array_syntax' => array('syntax' => 'short'),
        )
    )
    ->setFinder($finder);
