<?php
/**
 * tagDiv WordPress booster
 *
 * @package WordPress
 * @subpackage MeisterMag
 * @since MeisterMag 1.0
 */

// theme utility files
require get_template_directory() . '/includes/wp-booster/class-tagdiv-util.php';

// load the wp-booster_api
require get_template_directory() . '/includes/wp-booster/class-tagdiv-api-base.php';
require get_template_directory() . '/includes/wp-booster/class-tagdiv-api-block.php';
require get_template_directory() . '/includes/wp-booster/class-tagdiv-api-module.php';
require get_template_directory() . '/includes/wp-booster/class-tagdiv-api-thumb.php';
require get_template_directory() . '/includes/wp-booster/class-tagdiv-api-autoload.php';

// hook here to use the theme api
do_action( 'tagdiv_global_after' );

require get_template_directory() . '/includes/wp-booster/class-tagdiv-global-blocks.php'; // no autoload
require get_template_directory() . '/includes/wp-booster/class-tagdiv-menu.php'; 		// theme menu support
require get_template_directory() . '/includes/wp-booster/class-tagdiv-module.php'; 		// module builder
require get_template_directory() . '/includes/wp-booster/class-tagdiv-block.php'; 		// block builder

require get_template_directory() . '/includes/wp-booster/class-tagdiv-autoload-classes.php';

require get_template_directory() . '/includes/wp-booster/class-tagdiv-block-layout.php';
require get_template_directory() . '/includes/wp-booster/class-tagdiv-template-layout.php';
require get_template_directory() . '/includes/wp-booster/class-tagdiv-data-source.php';


/* ----------------------------------------------------------------------------
 * Add theme support for features
 */

if ( ! function_exists( 'tagdiv_setup' ) ) {
	function tagdiv_setup() {

		/**
		 * Localization
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'meistermag', get_template_directory() . '/languages' );

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
 * @since MeisterMag 1.0
 */
function tagdiv_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tagdiv_content_width', 640 );
}
add_action( 'after_setup_theme', 'tagdiv_content_width', 0 );

/* ----------------------------------------------------------------------------
 * Registers theme widget areas
 */

/**
 * Registers the theme sidebar and the footer widget areas.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since MeisterMag 1.0
 */
function tagdiv_widgets_init() {

	// Default sidebar
	register_sidebar( array(
		'name'          => __( 'Theme Default Sidebar', 'meistermag' ),
		'id'            => 'tagdiv-default',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'meistermag' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="tagdiv-block-title"><span>',
		'after_title'   => '</span></div>'
	) );

	// Footer sections
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'meistermag' ),
		'id'            => 'tagdiv-footer-1',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="tagdiv-block-title"><span>',
		'after_title'   => '</span></div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'meistermag' ),
		'id'            => 'tagdiv-footer-2',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="tagdiv-block-title"><span>',
		'after_title'   => '</span></div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'meistermag' ),
		'id'            => 'tagdiv-footer-3',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="tagdiv-block-title"><span>',
		'after_title'   => '</span></div>'
	) );

}
add_action( 'widgets_init', 'tagdiv_widgets_init' );


/* ----------------------------------------------------------------------------
 * Theme fonts & scripts
 */

if ( ! function_exists( 'tagdiv_fonts' ) ) {
	/**
	 * Register Google fonts.
	 *
	 * @since MeisterMag 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function tagdiv_fonts() {
		$fonts_url = '';
		$fonts = array();
		$subsets = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Work Sans font, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x( 'on', 'Work Sans font: on or off', 'meistermag') ) {
			$fonts[] = 'Work Sans:400,500,600,700';
		}

		/* translators: If there are characters in your language that are not supported by Source Sans Pro font, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x( 'on', 'Source Sans Pro font: on or off', 'meistermag') ) {
			$fonts[] = 'Source Sans Pro:400,400italic,600,600italic,700';
		}

		/* translators: If there are characters in your language that are not supported by Droid Serif font, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x( 'on', 'Droid Serif font: on or off', 'meistermag') ) {
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
 * @since MeisterMag 1.0
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

		wp_enqueue_script( TAGDIV_THEME_NAME . '-events-script', get_template_directory_uri() . '/includes/js_files/tdEvents.js', array( 'jquery' ), TAGDIV_THEME_VERSION, true );
		wp_enqueue_script( TAGDIV_THEME_NAME . '-detect-script', get_template_directory_uri() . '/includes/js_files/tdDetect.js', array(), TAGDIV_THEME_VERSION, true );
		wp_enqueue_script( TAGDIV_THEME_NAME . '-script', get_template_directory_uri() . '/includes/js_files/functions.js', array( 'jquery' ), TAGDIV_THEME_VERSION, true );
		wp_enqueue_script( TAGDIV_THEME_NAME . '-menu-script', get_template_directory_uri() . '/includes/js_files/tdMenu.js', array( 'jquery' ), TAGDIV_THEME_VERSION, true );
		wp_enqueue_script( TAGDIV_THEME_NAME . '-search-script', get_template_directory_uri() . '/includes/js_files/tdSearch.js', array( 'jquery' ), TAGDIV_THEME_VERSION, true );

		wp_localize_script( TAGDIV_THEME_NAME . '-script', 'screenReaderText', array(
			'expand'   => __( 'expand child menu', 'meistermag' ),
			'collapse' => __( 'collapse child menu', 'meistermag' ),
			'submenu'  => __( 'menu item with sub-menu', 'meistermag' ),
		) );
	}
}

add_action( 'wp_enqueue_scripts', 'tagdiv_scripts' );


/*  ----------------------------------------------------------------------------
    add span wrap for category number in widget
 */
add_filter( 'wp_list_categories', 'tagdiv_category_count_span' );
if ( ! function_exists( 'tagdiv_category_count_span' ) ) {
	function tagdiv_category_count_span( $links ) {
		$links = str_replace( '</a> (', '<span class="td-widget-no">', $links );
		$links = str_replace( ')', '</span></a>', $links );

		return $links;
	}
}


/*  ----------------------------------------------------------------------------
    gallery style css
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/**
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

}


/* ----------------------------------------------------------------------------
 *   Customizer: Sanitization Callbacks
 */

if ( ! function_exists( 'tagdiv_sanitize_checkbox' ) ) {
	/**
	 * Checkbox sanitization callback
	 *
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function tagdiv_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
}

if ( ! function_exists( 'tagdiv_sanitize_email' ) ) {
	/**
	 * Email sanitization callback
	 *
	 * - Sanitization: email
	 * - Control: text
	 *
	 * Sanitization callback for 'email' type text controls. This callback sanitizes `$email`
	 * as a valid email address.
	 *
	 * @see sanitize_email() https://developer.wordpress.org/reference/functions/sanitize_key/
	 * @link sanitize_email() https://codex.wordpress.org/Function_Reference/sanitize_email
	 *
	 * @param string               $email   Email address to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string The sanitized email if not null; otherwise, the setting default.
	 */
	function tagdiv_sanitize_email(  $email, $setting  ) {
		// Sanitize $input as a hex value without the hash prefix.
		$email = sanitize_email( $email );

		// If $email is a valid email, return it; otherwise, return the default.
		return ( ! is_null( $email ) ? $email : $setting->default );
	}
}

if ( ! function_exists( 'tagdiv_sanitize_image' ) ) {
	/**
	 * Image sanitization callback
	 *
	 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
	 * send back the filename, otherwise, return the setting default.
	 *
	 * - Sanitization: image file extension
	 * - Control: text, WP_Customize_Image_Control
	 *
	 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
	 *
	 * @param string               $image   Image filename.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string The image filename if the extension is allowed; otherwise, the setting default.
	 */
	function tagdiv_sanitize_image( $image, $setting ) {

		/*
         * Array of valid image file types.
         *
         * The array includes image mime types that are included in wp_get_mime_types()
         */
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon'
		);

		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );

		// If $image has a valid mime_type, return it; otherwise, return the default.
		return ( $file['ext'] ? $image : $setting->default );
	}
}






