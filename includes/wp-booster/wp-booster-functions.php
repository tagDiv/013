<?php
/**
 * WordPress booster V 3.1 by tagDiv
 */

// theme utility files
require_once( 'class-tagdiv-util.php' );


// load the wp-booster_api
require_once( 'class-tagdiv-api-base.php' );
require_once( 'class-tagdiv-api-block.php' );
require_once( 'class-tagdiv-api-module.php' );
require_once( 'class-tagdiv-api-thumb.php' );
require_once( 'class-tagdiv-api-autoload.php' );


require_once( 'class-tagdiv-autoload-classes.php' );

// hook here to use the theme api
do_action( 'tagdiv_global_after' );


require_once( 'class-tagdiv-global-blocks.php' );   // no autoload -
require_once( 'class-tagdiv-menu.php' );            // theme menu support


require_once( 'class-tagdiv-module.php' );          // module builder
require_once( 'class-tagdiv-block.php' );           // block builder


require_once( 'class-tagdiv-block-layout.php' );
require_once( 'class-tagdiv-template-layout.php' );
require_once( 'class-tagdiv-data-source.php' );


/* ----------------------------------------------------------------------------
 * Add theme support for features
 */
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'video' ) );
add_theme_support( 'automatic-feed-links' );

function theme_prefix_setup() {

	add_theme_support( 'custom-logo', array(
		'height'      => 90,
		'width'       => 272,
		'flex-width' => true,
	) );

}
add_action( 'after_setup_theme', 'theme_prefix_setup' );

add_theme_support( 'html5', array(
	'comment-list',
	'comment-form',
	'search-form',
	'gallery',
	'caption'
) );

add_theme_support( 'title-tag' );


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
    gallery style css
 */
add_filter( 'use_default_gallery_style', '__return_true' );


/* 	----------------------------------------------------------------------------
 * 	shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );

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
		Tagdiv_Global_Blocks::add_block_id( $block_settings_key );
	}


	/* ----------------------------------------------------------------------------
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
