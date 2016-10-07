<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

if ( is_active_sidebar( 'tagdiv-default' )  ) {
		dynamic_sidebar( 'tagdiv-default' );
} else {
	return;
}
