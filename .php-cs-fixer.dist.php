<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
        'phpdoc_align' => false,
        'yoda_style' => false,
        'declare_strict_types' => true,
        'no_superfluous_phpdoc_tags' => false,
        'single_line_throw' => false,
        'concat_space' => ['spacing' => 'one'],
    ])
    ->setFinder($finder)
;
