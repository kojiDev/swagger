<?php
use Symfony\CS\Config\Config;
use Symfony\CS\Finder\DefaultFinder;
use Symfony\CS\Fixer\Contrib\HeaderCommentFixer;
use Symfony\CS\FixerInterface;

$finder = DefaultFinder::create()
	->exclude('fixtures')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

return Config::create()
	->finder($finder)
	->setUsingCache(false);
