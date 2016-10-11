<?php


require_once 'deploy-mode.php';

// load the config
require_once( 'includes/class-tagdiv-config.php' );
add_action( 'tagdiv_global_after', array( 'Tagdiv_Config', 'on_tagdiv_global_after_config' ), 9 );
//we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10


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
	load_theme_textdomain( 'tdmag', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'td_load_text_domains');


/**
 * Enqueues scripts and styles.
 *
 * @since TAGDIV_THEME_NAME 1.0
 */
function tagdiv_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( TAGDIV_THEME_NAME . '-fonts', tagdiv_fonts(), array(), null );

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

if ( ! function_exists( 'tagdiv_fonts' ) ) {
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own tagdiv_fonts() function to override in a child theme.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function tagdiv_fonts() {
		$fonts_url = '';
		$fonts = array();
		$subsets = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Work Sans font, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x( 'on', 'Work Sans font: on or off', 'tdmag') ) {
			$fonts[] = 'Work Sans:400,500,600,700';
		}

		/* translators: If there are characters in your language that are not supported by Source Sans Pro font, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x( 'on', 'Source Sans Pro font: on or off', 'tdmag') ) {
			$fonts[] = 'Source Sans+Pro:400,400italic,600,600italic,700';
		}

		/* translators: If there are characters in your language that are not supported by Droid Serif font, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x( 'on', 'Droid Serif font: on or off', 'tdmag') ) {
			$fonts[] = 'Droid Serif:400,700';
		}

		if ($fonts) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode(implode('|', $fonts)),
				'subset' => urlencode($subsets),
			), 'https://fonts.googleapis.com/css');
		}

		return $fonts_url;
	}
}

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

