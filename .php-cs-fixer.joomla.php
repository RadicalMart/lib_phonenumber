<?php

return (new PhpCsFixer\Config())
	->setIndent("\t")
	->setFinder(
		\Symfony\Component\Finder\Finder::create()
			->in('joomla')
			->name('*.php')
	)
	->setRiskyAllowed(true)
	->setRules([
		// psr-1
		'encoding'                              => true,
		// psr-2
		'elseif'                                => true,
		'single_blank_line_at_eof'              => true,
		'no_spaces_after_function_name'         => true,
		'blank_line_after_namespace'            => true,
		'line_ending'                           => true,
		'constant_case'                         => ['case' => 'lower'],
		'lowercase_keywords'                    => true,
		'method_argument_space'                 => true,
		'single_import_per_statement'           => true,
		'no_spaces_inside_parenthesis'          => true,
		'single_line_after_imports'             => true,
		'no_trailing_whitespace'                => true,
		// symfony
		'no_whitespace_before_comma_in_array'   => true,
		'whitespace_after_comma_in_array'       => true,
		'no_empty_statement'                    => true,
		'simplified_null_return'                => true,
		'no_extra_blank_lines'                  => true,
		'function_typehint_space'               => true,
		'include'                               => true,
		'no_alias_functions'                    => true,
		'no_trailing_comma_in_list_call'        => true,
		'trailing_comma_in_multiline'           => ['elements' => ['arrays']],
		'no_blank_lines_after_class_opening'    => true,
		'phpdoc_trim'                           => true,
		'blank_line_before_statement'           => ['statements' => ['return']],
		'no_trailing_comma_in_singleline_array' => true,
		'single_blank_line_before_namespace'    => true,
		'cast_spaces'                           => true,
		'no_unused_imports'                     => true,
		'no_whitespace_in_blank_line'           => true,
		// contrib
		'concat_space'                          => ['spacing' => 'one'],
		/**
		 * PHP 7+ zend_try_compile_special_func compiles certain PHP Functions to opcode which is faster
		 * @see https://github.com/php/php-src/blob/9dc947522186766db4a7e2d603703a2250797577/Zend/zend_compile.c#L4192
		 */
		'native_function_invocation' => ['include' => ['@compiler_optimized'], 'scope' => 'namespaced', 'strict' => true],
	]);
