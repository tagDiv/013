<?php
/**
 * Created by ra.
 * Date: 9/14/2016
 */


/*  ----------------------------------------------------------------------------
    mbstring support - if missing from host
 */

if (!function_exists('mb_strlen')) {
	function mb_strlen ($string, $encoding = '') {
		return strlen($string);
	}
}

if (!function_exists('mb_strpos')) {
	function mb_strpos($haystack,$needle,$offset=0) {
		return strpos($haystack,$needle,$offset);
	}
}
if (!function_exists('mb_strrpos')) {
	function mb_strrpos ($haystack,$needle,$offset=0) {
		return strrpos($haystack,$needle,$offset);
	}
}
if (!function_exists('mb_strtolower')) {
	function mb_strtolower($string) {
		return strtolower($string);
	}
}
if (!function_exists('mb_strtoupper')) {
	function mb_strtoupper($string){
		return strtoupper($string);
	}
}
if (!function_exists('mb_substr')) {
	function mb_substr($string,$start,$length, $encoding = '') {
		return substr($string,$start,$length);
	}
}
