<?php
/**
 * Initialize preview on demo
 * @since MeisterMag 1.1.1
 */

/**
 * check if it's demo preview
 * @return bool
 */
function tagdiv_is_preview_demo() {
	$theme_object = wp_get_theme();
	$theme_name = $theme_object ->get( 'TextDomain' );
	$active_theme = tagdiv_get_raw_option( 'template' );

	if ( $active_theme != strtolower( $theme_name ) && ! is_child_theme() ) {
		return true;
	}

	return false;
}

/**
 * all options or a single option val
 *
 * @param string $option_name
 * @return bool|mixed
 */
function tagdiv_get_raw_option( $option_name ) {
	$all_options = wp_cache_get( 'alloptions', 'options' );
	$all_options = maybe_unserialize( $all_options );
	return isset( $all_options[$option_name] ) ? maybe_unserialize( $all_options[$option_name] ) : false;
}

/**
 * set the $tagdiv_is_demo_preview global if we're on demo preview.
 */
if ( tagdiv_is_preview_demo() ) {
	Tagdiv_Global::$tagdiv_is_demo_preview = true;
}