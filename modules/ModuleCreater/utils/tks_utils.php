<?php
/*+*******************************************************************************
 * The content of this file is subject to the CRMTiger Pro license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is vTiger
 * The Modified Code of the Original Code owned by https://crmtiger.com/
 * Portions created by CRMTiger.com are Copyright(C) CRMTiger.com
 * All Rights Reserved.
  ***************************************************************************** */

/**
 * Function to check values in array regardless of case
 */
function in_array_case_insensitive($needle, $haystack) 
{
	global $log;
	$log->debug("Entering in_array_case_insensitive($needle haystack array()) method....");
	$log->debug("Exiting in_array_case_insensitive($needle haystack array()) method....");
	return in_array( strtolower($needle), array_map('strtolower', $haystack) );
}

/**
 * Function to santize and check valid module name.
 */
function sanitizeModuleName($module)
{
	global $log;
	
	$log->debug("Entering sanitizeModuleName($module) method....");
		
	$func  = get_defined_functions();
	$vars  = get_defined_vars();
	$cls   = get_declared_classes();
	$keywords = array('__halt_compiler', 'abstract', 'and', 'array',
					 'as', 'break', 'callable', 'case', 'catch', 
					 'class', 'clone', 'const', 'continue', 'declare', 
					 'default', 'die', 'do', 'echo', 'else', 
					 'elseif', 'empty', 'enddeclare', 'endfor', 
					 'endforeach', 'endif', 'endswitch', 'endwhile', 
					 'eval', 'exit', 'extends', 'final', 'for', 'foreach', 
					 'function', 'global', 'goto', 'if', 'implements', 'include', 
					 'include_once', 'instanceof', 'insteadof', 
					 'interface', 'isset', 'list', 'namespace', 'new', 'or',
					 'print', 'private', 'protected', 'public', 'require', 
					 'require_once', 'return', 'static', 'switch', 'throw', 
					 'trait', 'try', 'unset', 'use', 'var', 'while', 'xor');

	$predefined_constants = array('__CLASS__', '__DIR__', '__FILE__', 
								  '__FUNCTION__', '__LINE__', '__METHOD__', 
								  '__NAMESPACE__', '__TRAIT__');
	
	if( in_array_case_insensitive( $module, $func['internal'] ) || in_array_case_insensitive( $module, $vars['func']['internal']) 
		|| in_array_case_insensitive( $module, $cls ) || in_array_case_insensitive( $module, $keywords ) 
		|| in_array_case_insensitive ( $module, $predefined_constants ) || function_exists( $module) 
		|| class_exists( $module) )
	{
		$log->debug("Exiting sanitizeModuleName($module) method.... MODULE NAME IS A KEYWORD");
		return true;
	}	
	$log->debug("Exiting sanitizeModuleName($module) method.... MODULE NAME IS UINQUE");
	return false;
}
/**
 * Function to sort an array on specific field
 */
function array_sort($array, $on, $order=SORT_ASC)
{
	global $log;
	$log->debug("Entering array_sort(array(),$on,$order) method....");
	
	$new_array = array();
	$sortable_array = array();

	if (count($array) > 0) {
		foreach ($array as $k => $v) {
			if (is_array($v)) {
				foreach ($v as $k2 => $v2) {
					if ($k2 == $on) {
						$sortable_array[$k] = $v2;
					}
				}
			} else {
				$sortable_array[$k] = $v;
			}
		}

		switch ($order) {
			case SORT_ASC:
				asort($sortable_array);
			break;
			case SORT_DESC:
				arsort($sortable_array);
			break;
		}

		foreach ($sortable_array as $k => $v) {
			$new_array[$k] = $array[$k];
		}
	}
	$log->debug("Exiting array_sort(array(),$on,$order) method....");
	return $new_array;
}
?>