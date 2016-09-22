<?php
/**
 * WordPress booster V 3.1 by tagDiv
 */

do_action( 'tagdiv_wp-booster_before' );  //@todo is probably not used by anyone


// theme utility files
require_once( 'class-tagdiv-global.php' );

Tagdiv_Global::$tagdiv_options = get_option( TAGDIV_THEME_NAME ); //read the theme settings once

if ( is_ssl() ) {
	Tagdiv_Global::$http_or_https = 'https';
}

Tagdiv_Global::$get_template_directory     = get_template_directory();
Tagdiv_Global::$get_template_directory_uri = get_template_directory_uri();


require_once( 'class-tagdiv-util.php' );


// load the wp-booster_api
require_once( 'class-tagdiv-api-base.php' );
require_once( 'class-tagdiv-api-block.php' );
require_once( 'class-tagdiv-api-module.php' );
require_once( 'class-tagdiv-api-block-template.php' );
require_once( 'class-tagdiv-api-thumb.php' );
require_once( 'class-tagdiv-api-autoload.php' );


require_once( 'class-tagdiv-autoload-classes.php' );

// hook here to use the theme api
do_action( 'tagdiv_global_after' );


require_once( 'class-tagdiv-global-blocks.php' );   // no autoload -
require_once('class-tagdiv-menu.php');            // theme menu support


require_once( 'class-tagdiv-module.php' );          // module builder
require_once( 'class-tagdiv-block.php' );           // block builder
require_once( 'class-tagdiv-block-widget.php' );    // no autoload - used to make widgets from our blocks


require_once( 'class-tagdiv-block-layout.php' );
require_once( 'class-tagdiv-css-compiler.php' );
require_once( 'class-tagdiv-css-buffer.php' );
require_once( 'class-tagdiv-data-source.php' );


/* ----------------------------------------------------------------------------
 * Ajax support
 */
//tagdiv_api_autoload::add('tagdiv_ajax', tagdiv_global::$get_template_directory . '/includes/wp-booster/tagdiv_ajax.php');
// ajax: block ajax hooks
add_action( 'wp_ajax_nopriv_tagdiv_ajax_block', array( 'tagdiv_ajax', 'on_ajax_block' ) );
add_action( 'wp_ajax_tagdiv_ajax_block', array( 'tagdiv_ajax', 'on_ajax_block' ) );


// at this point it's not safe to update the Theme API because it's already used
do_action( 'tagdiv_wp-booster_loaded' ); //used by our plugins


/* ----------------------------------------------------------------------------
 * Add theme support for features
 */
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'video' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array(
	'comment-list',
	'comment-form',
	'search-form',
	'gallery',
	'caption'
) );

add_theme_support( 'title-tag' );


/** ---------------------------------------------------------------------------
 * front end user compiled css @see  tagdiv_css_generator.php
 */
add_action( 'wp_head', 'tagdiv_include_user_compiled_css', 10 );
function tagdiv_include_user_compiled_css() {
	if ( ! is_admin() ) {

		$compiled_css = tagdiv_css_generator();   // get it live WARNING - it will always appear as autoloaded on DEV

		if ( ! empty( $compiled_css ) ) {
			Tagdiv_Css_Buffer::add_to_header( $compiled_css );
		}
	}
}


/* ----------------------------------------------------------------------------
 * farbtastic color picker CSS and JS for wp-admin / backend - loaded only in the widgets screen. Is used by our widget builder!
 */
function tagdiv_on_admin_print_scripts_farbtastic() {
	wp_enqueue_script( 'farbtastic' );
}

function tagdiv_on_admin_print_styles_farbtastic() {
	wp_enqueue_style( 'farbtastic' );
}

add_action( 'admin_print_scripts-widgets.php', 'tagdiv_on_admin_print_scripts_farbtastic' );
add_action( 'admin_print_styles-widgets.php', 'tagdiv_on_admin_print_styles_farbtastic' );


/**  ----------------------------------------------------------------------------
 * archive widget - adds .current class in the archive widget and maybe it's used in other places too!
 */
add_filter( 'get_archives_link', 'theme_get_archives_link' );
function theme_get_archives_link( $link_html ) {
	global $wp;
	static $current_url;
	if ( empty( $current_url ) ) {
		$current_url = esc_url( add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) ) );
	}
	if ( stristr( $current_url, 'page' ) !== false ) {
		$current_url = substr( $current_url, 0, strrpos( $current_url, 'page' ) );
	}
	if ( stristr( $link_html, $current_url ) !== false ) {
		$link_html = preg_replace( '/(<[^\s>]+)/', '\1 class="current"', $link_html, 1 );
	}

	return $link_html;
}


/*  ----------------------------------------------------------------------------
    add span wrap for category number in widget
 */
add_filter( 'wp_list_categories', 'cat_count_span' );
function cat_count_span( $links ) {
	$links = str_replace( '</a> (', '<span class="td-widget-no">', $links );
	$links = str_replace( ')', '</span></a>', $links );

	return $links;
}


/*  ----------------------------------------------------------------------------
    remove gallery style css
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/*  ----------------------------------------------------------------------------
    editor style
 */
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );
function my_theme_add_editor_styles() {
	if ( tagdiv_DEPLOY_MODE == 'dev' ) {
		// we need the full url here due to a WP strange s*it with ?queries
		add_editor_style( get_stylesheet_directory_uri() . '/tagdiv_less_style.css.php?part=editor-style' );
	} else {
		add_editor_style(); // add the default style
	}
}


/*  ----------------------------------------------------------------------------\
    used by ie8 - there is no other way to add js for ie8 only
 */
add_action( 'wp_head', 'add_ie_html5_shim' );
function add_ie_html5_shim() {
	echo '<!--[if lt IE 9]>';
	echo '<script src="' . Tagdiv_Global::$http_or_https . '://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
	echo '<![endif]-->
    ';
}


/* ----------------------------------------------------------------------------
 * shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );


/* ----------------------------------------------------------------------------
 * FILTER - the_content_more_link - read more - ?
 */
add_filter( 'the_content_more_link', 'tagdiv_remove_more_link_scroll' );
function tagdiv_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	$link = '<div class="more-link-wrap">' . $link . '</div>';

	return $link;
}


/* ----------------------------------------------------------------------------
 *   TagDiv WordPress booster init
 */

tagdiv_init_booster();
function tagdiv_init_booster() {

	global $content_width;

	// content width - this is overwritten in post
	if ( ! isset( $content_width ) ) {
		$content_width = 640;
	}


	/* ----------------------------------------------------------------------------
	 * add_image_size for WordPress - register all the thumbs from the thumblist
	 */
	foreach ( Tagdiv_API_Thumb::get_all() as $thumb_array ) {
		add_image_size( $thumb_array['name'], $thumb_array['width'], $thumb_array['height'], $thumb_array['crop'] );
	}


	/* ----------------------------------------------------------------------------
	 * Add lazy shortcodes of the registered blocks
	 */
	foreach ( Tagdiv_API_Block::get_all() as $block_settings_key => $block_settings_value ) {
		Tagdiv_Global_Blocks::add_lazy_shortcode( $block_settings_key );
	}


	/* ----------------------------------------------------------------------------
	* register the default sidebars + dynamic ones
	*/
	register_sidebar( array(
		'name'          => TAGDIV_THEME_NAME . ' default',
		'id'            => 'td-default', //the id is used by the importer
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="block-title"><span>',
		'after_title'   => '</span></div>'
	) );

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

	//get our custom dynamic sidebars
	$currentSidebars = Tagdiv_Util::get_option( 'sidebars' );

	//if we have user made sidebars, register them in wp
	if ( ! empty( $currentSidebars ) ) {
		foreach ( $currentSidebars as $sidebar ) {
			register_sidebar( array(
				'name'          => $sidebar,
				'id'            => 'td-' . Tagdiv_Util::sidebar_name_to_id( $sidebar ),
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="block-title"><span>',
				'after_title'   => '</span></div>',
			) );
		} //end foreach
	}

}


add_filter( 'redirect_canonical', 'tagdiv_fix_wp_441_pagination', 10, 2 );
function tagdiv_fix_wp_441_pagination( $redirect_url, $requested_url ) {
	global $wp_query;

	if ( is_page() && ! is_feed() && isset( $wp_query->queried_object ) && get_query_var( 'page' ) && get_page_template_slug( $wp_query->queried_object->ID ) == 'page-pagebuilder-latest.php' ) {
		return false;
	}

	return $redirect_url;
}