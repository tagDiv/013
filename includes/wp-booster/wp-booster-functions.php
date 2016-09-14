<?php
/**
 * WordPress booster V 3.1 by tagDiv
 */

do_action('tagdiv_wp-booster_before');  //@todo is probably not used by anyone


// theme utility files
require_once('class-tagdiv-global.php');
Tagdiv_Global::$tagdiv_options = get_option(tagdiv_THEME_OPTIONS_NAME); //read the theme settings once
if (is_ssl()) {
	Tagdiv_Global::$http_or_https = 'https';
}
Tagdiv_Global::$get_template_directory     = get_template_directory();
Tagdiv_Global::$get_template_directory_uri = get_template_directory_uri();






require_once('class-tagdiv-util.php');


// load the wp-booster_api
require_once('class-tagdiv-api-base.php');
require_once('class-tagdiv-api-block.php');
require_once('class-tagdiv-api-module.php');
require_once('class-tagdiv-api-block-template.php');
require_once('class-tagdiv-api-thumb.php');
require_once('class-tagdiv-api-autoload.php');


require_once('class-tagdiv-autoload-classes.php');

// hook here to use the theme api
do_action('tagdiv_global_after');


require_once('class-tagdiv-global-blocks.php');   // no autoload -
//require_once('tagdiv_menu.php');            // theme menu support



require_once('class-tagdiv-module.php');          // module builder
require_once('class-tagdiv-block.php');           // block builder
require_once('class-tagdiv-block-widget.php');    // no autoload - used to make widgets from our blocks


require_once('class-tagdiv-block-layout.php');
require_once('class-tagdiv-css-compiler.php');
require_once('class-tagdiv-css-buffer.php');
require_once('class-tagdiv-data-source.php');





/* ----------------------------------------------------------------------------
 * Ajax support
 */
//tagdiv_api_autoload::add('tagdiv_ajax', tagdiv_global::$get_template_directory . '/includes/wp-booster/tagdiv_ajax.php');
// ajax: block ajax hooks
add_action('wp_ajax_nopriv_tagdiv_ajax_block', array('tagdiv_ajax', 'on_ajax_block'));
add_action('wp_ajax_tagdiv_ajax_block',        array('tagdiv_ajax', 'on_ajax_block'));

// ajax: Renders loop pagination, for now used only on categories
add_action('wp_ajax_nopriv_tagdiv_ajax_loop', array('tagdiv_ajax', 'on_ajax_loop'));
add_action('wp_ajax_tagdiv_ajax_loop',        array('tagdiv_ajax', 'on_ajax_loop'));

// ajax: site wide search
add_action('wp_ajax_nopriv_tagdiv_ajax_search', array('tagdiv_ajax', 'on_ajax_search'));
add_action('wp_ajax_tagdiv_ajax_search',        array('tagdiv_ajax', 'on_ajax_search'));

// ajax: login window login
add_action('wp_ajax_nopriv_tagdiv_mod_login', array('tagdiv_ajax', 'on_ajax_login'));
add_action('wp_ajax_tagdiv_mod_login',        array('tagdiv_ajax', 'on_ajax_login'));

// ajax: login window register
add_action('wp_ajax_nopriv_tagdiv_mod_register', array('tagdiv_ajax', 'on_ajax_register'));
add_action('wp_ajax_tagdiv_mod_register',        array('tagdiv_ajax', 'on_ajax_register'));

// ajax: login window remember pass?
add_action('wp_ajax_nopriv_tagdiv_mod_remember_pass', array('tagdiv_ajax', 'on_ajax_remember_pass'));
add_action('wp_ajax_tagdiv_mod_remember_pass',        array('tagdiv_ajax', 'on_ajax_remember_pass'));

// ajax: update views - via ajax only when enable in panel
add_action('wp_ajax_nopriv_tagdiv_ajax_update_views', array('tagdiv_ajax', 'on_ajax_update_views'));
add_action('wp_ajax_tagdiv_ajax_update_views',        array('tagdiv_ajax', 'on_ajax_update_views'));

// ajax: get views - via ajax only when enabled in panel
add_action('wp_ajax_nopriv_tagdiv_ajax_get_views', array('tagdiv_ajax', 'on_ajax_get_views'));
add_action('wp_ajax_tagdiv_ajax_get_views',        array('tagdiv_ajax', 'on_ajax_get_views'));


// Secure Ajax
add_action('wp_ajax_tagdiv_ajax_new_sidebar', array('tagdiv_ajax', 'on_ajax_new_sidebar'));        // ajax: admin panel - new sidebar #sec
add_action('wp_ajax_tagdiv_ajax_delete_sidebar', array('tagdiv_ajax', 'on_ajax_delete_sidebar'));  // ajax: admin panel - delete sidebar #sec



// at this point it's not safe to update the Theme API because it's already used
do_action('tagdiv_wp-booster_loaded'); //used by our plugins



/* ----------------------------------------------------------------------------
 * Add theme support for features
 */
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('video'));
add_theme_support('automatic-feed-links');
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
add_theme_support('woocommerce');



/* ----------------------------------------------------------------------------
 * front end css files
 */
add_action('wp_enqueue_scripts', 'load_front_css', 1001);   // 1001 priority because visual composer uses 1000
function load_front_css() {



	$demo_id = Tagdiv_Util::get_loaded_demo_id();


	if (tagdiv_DEBUG_USE_LESS) {
		wp_enqueue_style('td-theme', Tagdiv_Global::$get_template_directory_uri . '/tagdiv_less_style.css.php?part=style.css_v2',  '', tagdiv_THEME_VERSION, 'all' );

		if ( Tagdiv_Global::$is_woocommerce_installed === true) {
			wp_enqueue_style('td-theme-woo', Tagdiv_Global::$get_template_directory_uri . '/tagdiv_less_style.css.php?part=woocommerce', '', tagdiv_THEME_VERSION, 'all');
		}

		if ($demo_id !== false and Tagdiv_Global::$demo_list[$demo_id]['uses_custom_style_css'] === true) {
			wp_enqueue_style('td-theme-demo-style', Tagdiv_Global::$get_template_directory_uri . '/tagdiv_less_style.css.php?part=' . $demo_id, '', tagdiv_THEME_VERSION, 'all');
		}
	} else {
		wp_enqueue_style('td-theme', get_stylesheet_uri(), '', tagdiv_THEME_VERSION, 'all' );
		if ( Tagdiv_Global::$is_woocommerce_installed === true) {
			wp_enqueue_style('td-theme-woo', Tagdiv_Global::$get_template_directory_uri . '/style-woocommerce.css',  '', tagdiv_THEME_VERSION, 'all' );
		}

		if ($demo_id !== false and Tagdiv_Global::$demo_list[$demo_id]['uses_custom_style_css'] === true) {
			wp_enqueue_style('td-theme-demo-style', Tagdiv_Global::$get_template_directory_uri . '/includes/demos/' . $demo_id . '/demo_style.css', '', tagdiv_THEME_VERSION, 'all');
		}

	}
}

/** ---------------------------------------------------------------------------
 * front end user compiled css @see  tagdiv_css_generator.php
 */
function tagdiv_include_user_compiled_css() {
	if (!is_admin()) {

		// add the global css compiler
		if (tagdiv_DEPLOY_MODE == 'dev') {
			$compiled_css = tagdiv_css_generator();   // get it live WARNING - it will always appear as autoloaded on DEV
		} else {
			$compiled_css = Tagdiv_Util::get_option('tds_user_compile_css');   // get it from the cache - do not compile at runtime
		}



		if (!empty($compiled_css)) {
			Tagdiv_Css_Buffer::add_to_header($compiled_css);
		}


		$demo_state = Tagdiv_Util::get_loaded_demo_id();
		if ($demo_state !== false) {
			if ( Tagdiv_Global::$demo_list[$demo_state]['tagdiv_css_generator_demo'] === true) {
				require_once( Tagdiv_Global::$demo_list[$demo_state]['folder'] . 'tagdiv_css_generator_demo.php');
				$demo_compiled_css = tagdiv_css_demo_gen();
				if (!empty($demo_compiled_css)) {
					Tagdiv_Css_Buffer::add_to_header( PHP_EOL . PHP_EOL . PHP_EOL . '/* Style generated by theme for demo: ' . $demo_state . ' */' . PHP_EOL);
					Tagdiv_Css_Buffer::add_to_header($demo_compiled_css);
				}
			}
		}

	}
}
add_action('wp_head', 'tagdiv_include_user_compiled_css', 10);



/* ----------------------------------------------------------------------------
 * front end javascript files
 */
add_action('wp_enqueue_scripts', 'load_front_js');
function load_front_js() {
	$tagdiv_deploy_mode = tagdiv_DEPLOY_MODE;

	//switch the deploy mode to demo if we have tagDiv speed booster
	if (defined('tagdiv_SPEED_BOOSTER')) {
		$tagdiv_deploy_mode = 'demo';
	}


	switch ($tagdiv_deploy_mode) {
		default: //deploy
			wp_enqueue_script('td-site', Tagdiv_Global::$get_template_directory_uri . '/js/tagdiv_theme.js', array('jquery'), tagdiv_THEME_VERSION, true);
			break;

		case 'demo':
			wp_enqueue_script('td-site-min', Tagdiv_Global::$get_template_directory_uri . '/js/tagdiv_theme.min.js', array('jquery'), tagdiv_THEME_VERSION, true);
			break;

		case 'dev':
			// dev version - load each file separately
			$last_js_file_id = '';
			foreach (Tagdiv_Global::$js_files as $js_file_id => $js_file) {
				if ($last_js_file_id == '') {
					wp_enqueue_script($js_file_id, Tagdiv_Global::$get_template_directory_uri . $js_file, array('jquery'), tagdiv_THEME_VERSION, true); //first, load it with jQuery dependency
				} else {
					wp_enqueue_script($js_file_id, Tagdiv_Global::$get_template_directory_uri . $js_file, array($last_js_file_id), tagdiv_THEME_VERSION, true);  //not first - load with the last file dependency
				}
				$last_js_file_id = $js_file_id;
			}
			break;

	}

	//add the comments reply to script on single pages
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
}




/* ----------------------------------------------------------------------------
 * css for wp-admin / backend
 */
add_action('admin_enqueue_scripts', 'load_wp_admin_css');
function load_wp_admin_css() {
	//load the panel font in wp-admin
	$tagdiv_protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style('google-font-ubuntu', $tagdiv_protocol . '://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&amp;subset=latin,cyrillic-ext,greek-ext,greek,latin-ext,cyrillic'); //used on content
	if (tagdiv_DEPLOY_MODE == 'dev') {
		wp_enqueue_style('td-wp-admin-td-panel-2', Tagdiv_Global::$get_template_directory_uri . '/tagdiv_less_style.css.php?part=wp-admin.css', false, tagdiv_THEME_VERSION, 'all' );
	} else {
		wp_enqueue_style('td-wp-admin-td-panel-2', Tagdiv_Global::$get_template_directory_uri . '/includes/wp-booster/wp-admin/css/wp-admin.css', false, tagdiv_THEME_VERSION, 'all' );
	}


	//load the colorpicker
	wp_enqueue_style( 'wp-color-picker' );
}




/* ----------------------------------------------------------------------------
 * farbtastic color picker CSS and JS for wp-admin / backend - loaded only in the widgets screen. Is used by our widget builder!
 */
function tagdiv_on_admin_print_scripts_farbtastic() {
	wp_enqueue_script('farbtastic');
}
function tagdiv_on_admin_print_styles_farbtastic() {
	wp_enqueue_style('farbtastic');
}
add_action('admin_print_scripts-widgets.php', 'tagdiv_on_admin_print_scripts_farbtastic');
add_action('admin_print_styles-widgets.php', 'tagdiv_on_admin_print_styles_farbtastic');




/* ----------------------------------------------------------------------------
 * js for wp-admin / backend   admin js - we use this strange thing to make sure that our scripts are depended on each other
 * and appear one after another exactly like we add them in tagdiv_global.php
 */
add_action('admin_enqueue_scripts', 'load_wp_admin_js');
function load_wp_admin_js() {


	$current_page_slug = '';
	if (isset($_GET['page'])) {
		$current_page_slug = $_GET['page'];
	}


	// dev version - load each file separately
	$last_js_file_id = '';
	foreach (Tagdiv_Global::$js_files_for_wp_admin as $js_file_id => $js_file_params) {

		// skip a file if it has custom page_slugs
		if (!empty($js_file_params['show_only_on_page_slugs']) and !in_array($current_page_slug, $js_file_params['show_only_on_page_slugs'])) {
			continue;
		}

		if ($last_js_file_id == '') {
			wp_enqueue_script($js_file_id, Tagdiv_Global::$get_template_directory_uri . $js_file_params['url'], array('jquery', 'wp-color-picker'), tagdiv_THEME_VERSION, false); //first, load it with jQuery dependency
		} else {
			wp_enqueue_script($js_file_id, Tagdiv_Global::$get_template_directory_uri . $js_file_params['url'], array($last_js_file_id), tagdiv_THEME_VERSION, false);  //not first - load with the last file dependency
		}
		$last_js_file_id = $js_file_id;
	}

	wp_enqueue_script('thickbox');
	add_thickbox();

}




/**  ----------------------------------------------------------------------------
archive widget - adds .current class in the archive widget and maybe it's used in other places too!
 */
add_filter('get_archives_link', 'theme_get_archives_link');
function theme_get_archives_link ( $link_html ) {
	global $wp;
	static $current_url;
	if ( empty( $current_url ) ) {
		$current_url = esc_url(add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) ));
	}
	if ( stristr( $current_url, 'page' ) !== false ) {
		$current_url = substr($current_url, 0, strrpos($current_url, 'page'));
	}
	if ( stristr( $link_html, $current_url ) !== false ) {
		$link_html = preg_replace( '/(<[^\s>]+)/', '\1 class="current"', $link_html, 1 );
	}
	return $link_html;
}




/*  ----------------------------------------------------------------------------
    add span wrap for category number in widget
 */
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
	$links = str_replace('</a> (', '<span class="td-widget-no">', $links);
	$links = str_replace(')', '</span></a>', $links);
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
	if (tagdiv_DEPLOY_MODE == 'dev') {
		// we need the full url here due to a WP strange s*it with ?queries
		add_editor_style(get_stylesheet_directory_uri() . '/tagdiv_less_style.css.php?part=editor-style');
	} else {
		add_editor_style(); // add the default style
	}
}






/*  ----------------------------------------------------------------------------\
    used by ie8 - there is no other way to add js for ie8 only
 */
add_action('wp_head', 'add_ie_html5_shim');
function add_ie_html5_shim () {
	echo '<!--[if lt IE 9]>';
	echo '<script src="' . Tagdiv_Global::$http_or_https . '://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
	echo '<![endif]-->
    ';
}



/* ----------------------------------------------------------------------------
 * shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');




/* ----------------------------------------------------------------------------
 * FILTER - the_content_more_link - read more - ?
 */
add_filter('the_content_more_link', 'tagdiv_remove_more_link_scroll');
function tagdiv_remove_more_link_scroll($link) {
	$link = preg_replace('|#more-[0-9]+|', '', $link);
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
	if (!isset($content_width)) {
		$content_width = 640;
	}


	/* ----------------------------------------------------------------------------
	 * Add lazy shortcodes of the registered blocks
	 */
	foreach (Tagdiv_API_Block::get_all() as $block_settings_key => $block_settings_value) {
		Tagdiv_Global_Blocks::add_lazy_shortcode($block_settings_key);
	}


	/* ----------------------------------------------------------------------------
	* register the default sidebars + dynamic ones
	*/
	register_sidebar(array(
		'name'=> tagdiv_THEME_NAME . ' default',
		'id' => 'td-default', //the id is used by the importer
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="block-title"><span>',
		'after_title' => '</span></div>'
	));

	register_sidebar(array(
		'name'=>'Footer 1',
		'id' => 'td-footer-1',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="block-title"><span>',
		'after_title' => '</span></div>'
	));

	register_sidebar(array(
		'name'=>'Footer 2',
		'id' => 'td-footer-2',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="block-title"><span>',
		'after_title' => '</span></div>'
	));

	register_sidebar(array(
		'name'=>'Footer 3',
		'id' => 'td-footer-3',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="block-title"><span>',
		'after_title' => '</span></div>'
	));

	//get our custom dynamic sidebars
	$currentSidebars = Tagdiv_Util::get_option('sidebars');

	//if we have user made sidebars, register them in wp
	if (!empty($currentSidebars)) {
		foreach ($currentSidebars as $sidebar) {
			register_sidebar(array(
				'name' => $sidebar,
				'id' => 'td-' . Tagdiv_Util::sidebar_name_to_id($sidebar),
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<div class="block-title"><span>',
				'after_title' => '</span></div>',
			));
		} //end foreach
	}

}






add_filter('redirect_canonical', 'tagdiv_fix_wp_441_pagination', 10, 2);
function tagdiv_fix_wp_441_pagination($redirect_url, $requested_url) {
	global $wp_query;

	if (is_page() && !is_feed() && isset($wp_query->queried_object) && get_query_var('page') && get_page_template_slug($wp_query->queried_object->ID) == 'page-pagebuilder-latest.php') {
		return false;
	}

	return $redirect_url;
}
