<?php


require_once 'deploy-mode.php';

// load the config
require_once('includes/class-tagdiv-config.php');
add_action('tagdiv_global_after', array('Tagdiv_Config', 'on_tagdiv_global_after_config'), 9); //we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10


require_once('includes/wp-booster/wp-booster-transition.php');
require_once('includes/wp-booster/wp-booster-functions.php');

require_once('includes/tagdiv_css_generator.php');




function __td($tagdiv_string, $tagdiv_domain = '') {
	return $tagdiv_string;
}

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( TAGDIV_THEME_NAME . '-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( TAGDIV_THEME_NAME . '-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( TAGDIV_THEME_NAME . '-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( TAGDIV_THEME_NAME . '-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( TAGDIV_THEME_NAME . '-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( TAGDIV_THEME_NAME . '-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );