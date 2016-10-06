<?php


require_once 'deploy-mode.php';

// load the config
require_once( 'includes/class-tagdiv-config.php' );
add_action( 'tagdiv_global_after', array( 'Tagdiv_Config', 'on_tagdiv_global_after_config' ), 9 ); //we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10


require_once( 'includes/wp-booster/wp-booster-transition.php' );
require_once( 'includes/wp-booster/wp-booster-functions.php' );

require_once( 'includes/tagdiv_css_generator.php' );


/**
 * Custom template tags for this theme.
 */
require_once( 'includes/template-tags.php' );


/**
 * Customizer additions.
 */
require_once( 'includes/customizer.php' );


/**
 * Localization
 */
function td_load_text_domains() {
	load_theme_textdomain( 'tdmag');
}
add_action('after_setup_theme', 'td_load_text_domains');

function __td( $tagdiv_string, $tagdiv_domain = '' ) {
	return $tagdiv_string;
}


/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function tagdiv_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( TAGDIV_THEME_NAME . '-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( TAGDIV_THEME_NAME . '-html5', get_template_directory_uri() . '/includes/js_files/html5.js', array(), '3.7.3' );
	wp_script_add_data( TAGDIV_THEME_NAME . '-html5', 'conditional', 'lt IE 9' );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( TAGDIV_THEME_NAME . '-script', get_template_directory_uri() . '/includes/js_files/functions.js', array( 'jquery' ), '20160816', true );
	wp_enqueue_script( TAGDIV_THEME_NAME . '-menu-script', get_template_directory_uri() . '/includes/js_files/tdMenu.js', array( 'jquery' ), '20160819', true );
	wp_enqueue_script( TAGDIV_THEME_NAME . '-search-script', get_template_directory_uri() . '/includes/js_files/tdSearch.js', array( 'jquery' ), '20160819', true );

	wp_localize_script( TAGDIV_THEME_NAME . '-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', TAGDIV_THEME_NAME ),
		'collapse' => __( 'collapse child menu', TAGDIV_THEME_NAME ),
	) );
}
add_action( 'wp_enqueue_scripts', 'tagdiv_scripts' );


/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

