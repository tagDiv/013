<?php
/**
 * WordPress booster - by tagDiv
 */

// theme utility files
require_once( 'class-tagdiv-util.php' );

// load the wp-booster_api
require_once( 'class-tagdiv-api-base.php' );
require_once( 'class-tagdiv-api-block.php' );
require_once( 'class-tagdiv-api-module.php' );
require_once( 'class-tagdiv-api-thumb.php' );
require_once( 'class-tagdiv-api-autoload.php' );

// hook here to use the theme api
do_action( 'tagdiv_global_after' );

require_once( 'class-tagdiv-global-blocks.php' );   // no autoload
require_once( 'class-tagdiv-menu.php' );            // theme menu support
require_once( 'class-tagdiv-module.php' );          // module builder
require_once( 'class-tagdiv-block.php' );           // block builder

require_once( 'class-tagdiv-autoload-classes.php' );

require_once( 'class-tagdiv-block-layout.php' );
require_once( 'class-tagdiv-template-layout.php' );
require_once( 'class-tagdiv-data-source.php' );


/* ----------------------------------------------------------------------------
 * Add theme support for features
 */

if ( ! function_exists( 'tagdiv_setup' ) ) {
	function tagdiv_setup() {

		/**
		 * Localization
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'tdmag', get_template_directory() . '/languages' );


		/**
		 * Enable support for Post Formats.
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		) );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 90,
			'width'       => 272,
			'flex-width' => true,
		) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption'
		) );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
}
add_action('after_setup_theme', 'tagdiv_setup');


/* ----------------------------------------------------------------------------
 * Set content width global
 */

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since TAGDIV_THEME_NAME 1.0
 */
function tagdiv_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tagdiv_content_width', 640 );
}
add_action( 'after_setup_theme', 'tagdiv_content_width', 0 );


/* ----------------------------------------------------------------------------
 * Theme fonts & scripts
 */

if ( ! function_exists( 'tagdiv_fonts' ) ) {
	/**
	 * Register Google fonts.
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
			$fonts[] = 'Source Sans Pro:400,400italic,600,600italic,700';
		}

		/* translators: If there are characters in your language that are not supported by Droid Serif font, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x( 'on', 'Droid Serif font: on or off', 'tdmag') ) {
			$fonts[] = 'Droid Serif:400,700';
		}

		if ($fonts) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode($subsets),
			), 'https://fonts.googleapis.com/css');
		}

		return $fonts_url;
	}
}

/**
 * Enqueues scripts and styles.
 *
 * @since TAGDIV_THEME_NAME 1.0
 */

if ( ! function_exists( 'tagdiv_scripts' ) ) {
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

		wp_enqueue_script( TAGDIV_THEME_NAME . '-events-script', get_template_directory_uri() . '/includes/js_files/tdEvents.js', array( 'jquery' ), '20160819', true );
		wp_enqueue_script( TAGDIV_THEME_NAME . '-detect-script', get_template_directory_uri() . '/includes/js_files/tdDetect.js', array( 'jquery' ), '20160819', true );
		wp_enqueue_script( TAGDIV_THEME_NAME . '-script', get_template_directory_uri() . '/includes/js_files/functions.js', array( 'jquery' ), '20160816', true );
		wp_enqueue_script( TAGDIV_THEME_NAME . '-menu-script', get_template_directory_uri() . '/includes/js_files/tdMenu.js', array( 'jquery' ), '20160819', true );
		wp_enqueue_script( TAGDIV_THEME_NAME . '-search-script', get_template_directory_uri() . '/includes/js_files/tdSearch.js', array( 'jquery' ), '20160819', true );

		wp_localize_script( TAGDIV_THEME_NAME . '-script', 'screenReaderText', array(
			'expand'   => __( 'expand child menu', TAGDIV_THEME_NAME ),
			'collapse' => __( 'collapse child menu', TAGDIV_THEME_NAME ),
		) );
	}
}

add_action( 'wp_enqueue_scripts', 'tagdiv_scripts' );


/*  ----------------------------------------------------------------------------
    add span wrap for category number in widget
 */
add_filter( 'wp_list_categories', 'tagdiv_category_count_span' );
function tagdiv_category_count_span( $links ) {
	$links = str_replace( '</a> (', '<span class="td-widget-no">', $links );
	$links = str_replace( ')', '</span></a>', $links );

	return $links;
}


/*  ----------------------------------------------------------------------------
    gallery style css
 */
add_filter( 'use_default_gallery_style', '__return_true' );


/* 	----------------------------------------------------------------------------
 * 	shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * ----------------------------------------------------------------------------
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wp_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wp_custom_excerpt_length', 999 );

/* ----------------------------------------------------------------------------
 *   TagDiv WordPress booster init
 */

tagdiv_init_booster();
function tagdiv_init_booster() {

	/*
	 * add_image_size for WordPress - register all the thumbs from the thumblist
	 */
	foreach ( Tagdiv_API_Thumb::get_all() as $thumb_array ) {
		add_image_size( $thumb_array['name'], $thumb_array['width'], $thumb_array['height'], $thumb_array['crop'] );
	}


	/*
	 * Add lazy shortcodes of the registered blocks
	 */
	foreach ( Tagdiv_API_Block::get_all() as $block_settings_key => $block_settings_value ) {
		Tagdiv_Global_Blocks::add_block_id( $block_settings_key );
	}


	/*
	* register the theme sidebars
	*/

	// Default sidebar
	register_sidebar( array(
		'name'          => 'Theme Default Sidebar',
		'id'            => 'tagdiv-default',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="block-title"><span>',
		'after_title'   => '</span></div>'
	) );

	// Footer
	register_sidebar( array(
		'name'          => 'Footer 1',
		'id'            => 'td-footer-1',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="block-title"><span>',
		'after_title'   => '</span></div>'
	) );

	register_sidebar( array(
		'name'          => 'Footer 2',
		'id'            => 'td-footer-2',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="block-title"><span>',
		'after_title'   => '</span></div>'
	) );

	register_sidebar( array(
		'name'          => 'Footer 3',
		'id'            => 'td-footer-3',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="block-title"><span>',
		'after_title'   => '</span></div>'
	) );
}


