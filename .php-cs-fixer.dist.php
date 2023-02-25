<?php

return (new PhpCsFixer\Config())
	->setIndent("\t")
	->setFinder(
		\Symfony\Component\Finder\Finder::create()
			->in('src')
			->in('tests')
			->name('*.php')
	)
	->setRiskyAllowed(true)
	->setRules([
		'@PSR12' => true,
		'array_indentation' => true,
		'declare_strict_types' => false,
		'final_class' => false,
		'global_namespace_import' => [
			'import_classes' => true,
			'import_constants' => true,
			'import_functions' => true,
		],
		'list_syntax' => [
			'syntax' => 'short',
		],
		'constant_case' => [
			'case' => 'lower',
		],
		'no_unused_imports' => true,
		'no_useless_else' => true,
		'no_useless_return' => true,
		'ordered_imports' => [
			'imports_order' => ['class', 'function', 'const'],
		],
		'single_import_per_statement' => true,
	]);
