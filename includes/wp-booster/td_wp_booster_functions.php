<?php
/**
 * WordPress booster V 3.1 by tagDiv
 */

do_action('td_wp-booster_before');  //@todo is probably not used by anyone


// theme utility files
require_once('td_global.php');
td_global::$td_options = get_option(TD_THEME_OPTIONS_NAME); //read the theme settings once

require_once('td_util.php');


// load the wp-booster_api
require_once('td_api_base.php');
require_once('td_api_block.php');
require_once('td_api_module.php');
require_once('td_api_autoload.php');
require_once('td_api_block_template.php');
require_once('td_api_thumb.php');



// hook here to use the theme api
do_action('td_global_after');


require_once('td_global_blocks.php');   // no autoload -
//require_once('td_menu.php');            // theme menu support



require_once('td_module.php');          // module builder
require_once('td_block.php');           // block builder
require_once('td_block_widget.php');    // no autoload - used to make widgets from our blocks



require_once('td_autoload_classes.php');  //used to autoload classes [modules, blocks]
// Every class after this (that has td_ in the name) is auto loaded only when it's required
td_api_autoload::add('td_log', td_global::$get_template_directory . '/includes/wp-booster/td_log.php');
td_api_autoload::add('td_css_inline', td_global::$get_template_directory . '/includes/wp-booster/td_css_inline.php');
td_api_autoload::add('td_login', td_global::$get_template_directory . '/includes/wp-booster/td_login.php');
td_api_autoload::add('td_category_template', td_global::$get_template_directory . '/includes/wp-booster/td_category_template.php');
td_api_autoload::add('td_category_top_posts_style', td_global::$get_template_directory . '/includes/wp-booster/td_category_top_posts_style.php');
td_api_autoload::add('td_page_generator', td_global::$get_template_directory . '/includes/wp-booster/td_page_generator.php');   //not used on some homepages
td_api_autoload::add('td_block_layout', td_global::$get_template_directory . '/includes/wp-booster/td_block_layout.php');
td_api_autoload::add('td_template_layout', td_global::$get_template_directory . '/includes/wp-booster/td_template_layout.php');
td_api_autoload::add('td_css_compiler', td_global::$get_template_directory . '/includes/wp-booster/td_css_compiler.php');
td_api_autoload::add('td_module_single_base', td_global::$get_template_directory . '/includes/wp-booster/td_module_single_base.php');
td_api_autoload::add('td_smart_list', td_global::$get_template_directory . '/includes/wp-booster/td_smart_list.php');
td_api_autoload::add('td_remote_cache', td_global::$get_template_directory . '/includes/wp-booster/td_remote_cache.php');
td_api_autoload::add('td_remote_http', td_global::$get_template_directory . '/includes/wp-booster/td_remote_http.php');
td_api_autoload::add('td_weather', td_global::$get_template_directory . '/includes/wp-booster/td_weather.php');
td_api_autoload::add('td_exchange', td_global::$get_template_directory . '/includes/wp-booster/td_exchange.php');
td_api_autoload::add('td_instagram', td_global::$get_template_directory . '/includes/wp-booster/td_instagram.php');
td_api_autoload::add('td_remote_video', td_global::$get_template_directory . '/includes/wp-booster/td_remote_video.php');
td_api_autoload::add('td_css_buffer', td_global::$get_template_directory . '/includes/wp-booster/td_css_buffer.php');
td_api_autoload::add('td_data_source', td_global::$get_template_directory . '/includes/wp-booster/td_data_source.php');






/* ----------------------------------------------------------------------------
 * Ajax support
 */
td_api_autoload::add('td_ajax', td_global::$get_template_directory . '/includes/wp-booster/td_ajax.php');
// ajax: block ajax hooks
add_action('wp_ajax_nopriv_td_ajax_block', array('td_ajax', 'on_ajax_block'));
add_action('wp_ajax_td_ajax_block',        array('td_ajax', 'on_ajax_block'));

// ajax: Renders loop pagination, for now used only on categories
add_action('wp_ajax_nopriv_td_ajax_loop', array('td_ajax', 'on_ajax_loop'));
add_action('wp_ajax_td_ajax_loop',        array('td_ajax', 'on_ajax_loop'));

// ajax: site wide search
add_action('wp_ajax_nopriv_td_ajax_search', array('td_ajax', 'on_ajax_search'));
add_action('wp_ajax_td_ajax_search',        array('td_ajax', 'on_ajax_search'));

// ajax: login window login
add_action('wp_ajax_nopriv_td_mod_login', array('td_ajax', 'on_ajax_login'));
add_action('wp_ajax_td_mod_login',        array('td_ajax', 'on_ajax_login'));

// ajax: login window register
add_action('wp_ajax_nopriv_td_mod_register', array('td_ajax', 'on_ajax_register'));
add_action('wp_ajax_td_mod_register',        array('td_ajax', 'on_ajax_register'));

// ajax: login window remember pass?
add_action('wp_ajax_nopriv_td_mod_remember_pass', array('td_ajax', 'on_ajax_remember_pass'));
add_action('wp_ajax_td_mod_remember_pass',        array('td_ajax', 'on_ajax_remember_pass'));

// ajax: update views - via ajax only when enable in panel
add_action('wp_ajax_nopriv_td_ajax_update_views', array('td_ajax', 'on_ajax_update_views'));
add_action('wp_ajax_td_ajax_update_views',        array('td_ajax', 'on_ajax_update_views'));

// ajax: get views - via ajax only when enabled in panel
add_action('wp_ajax_nopriv_td_ajax_get_views', array('td_ajax', 'on_ajax_get_views'));
add_action('wp_ajax_td_ajax_get_views',        array('td_ajax', 'on_ajax_get_views'));


// Secure Ajax
add_action('wp_ajax_td_ajax_new_sidebar', array('td_ajax', 'on_ajax_new_sidebar'));        // ajax: admin panel - new sidebar #sec
add_action('wp_ajax_td_ajax_delete_sidebar', array('td_ajax', 'on_ajax_delete_sidebar'));  // ajax: admin panel - delete sidebar #sec



// at this point it's not safe to update the Theme API because it's already used
do_action('td_wp-booster_loaded'); //used by our plugins



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



	$demo_id = td_util::get_loaded_demo_id();


	if (TD_DEBUG_USE_LESS) {
		wp_enqueue_style('td-theme', td_global::$get_template_directory_uri . '/td_less_style.css.php?part=style.css_v2',  '', TD_THEME_VERSION, 'all' );

		if (td_global::$is_woocommerce_installed === true) {
			wp_enqueue_style('td-theme-woo', td_global::$get_template_directory_uri . '/td_less_style.css.php?part=woocommerce', '', TD_THEME_VERSION, 'all');
		}

		if ($demo_id !== false and td_global::$demo_list[$demo_id]['uses_custom_style_css'] === true) {
			wp_enqueue_style('td-theme-demo-style', td_global::$get_template_directory_uri . '/td_less_style.css.php?part=' . $demo_id, '', TD_THEME_VERSION, 'all');
		}
	} else {
		wp_enqueue_style('td-theme', get_stylesheet_uri(), '', TD_THEME_VERSION, 'all' );
		if (td_global::$is_woocommerce_installed === true) {
			wp_enqueue_style('td-theme-woo', td_global::$get_template_directory_uri . '/style-woocommerce.css',  '', TD_THEME_VERSION, 'all' );
		}

		if ($demo_id !== false and td_global::$demo_list[$demo_id]['uses_custom_style_css'] === true) {
			wp_enqueue_style('td-theme-demo-style', td_global::$get_template_directory_uri . '/includes/demos/' . $demo_id . '/demo_style.css', '', TD_THEME_VERSION, 'all');
		}

	}
}

/** ---------------------------------------------------------------------------
 * front end user compiled css @see  td_css_generator.php
 */
function td_include_user_compiled_css() {
	if (!is_admin()) {

		// add the global css compiler
		if (TD_DEPLOY_MODE == 'dev') {
			$compiled_css = td_css_generator();   // get it live WARNING - it will always appear as autoloaded on DEV
		} else {
			$compiled_css = td_util::get_option('tds_user_compile_css');   // get it from the cache - do not compile at runtime
		}



		if (!empty($compiled_css)) {
			td_css_buffer::add_to_header($compiled_css);
		}


		$demo_state = td_util::get_loaded_demo_id();
		if ($demo_state !== false) {
			if (td_global::$demo_list[$demo_state]['td_css_generator_demo'] === true) {
				require_once(td_global::$demo_list[$demo_state]['folder'] . 'td_css_generator_demo.php');
				$demo_compiled_css = td_css_demo_gen();
				if (!empty($demo_compiled_css)) {
					td_css_buffer::add_to_header(PHP_EOL . PHP_EOL . PHP_EOL .'/* Style generated by theme for demo: ' . $demo_state . ' */'  . PHP_EOL);
					td_css_buffer::add_to_header($demo_compiled_css);
				}
			}
		}

	}
}
add_action('wp_head', 'td_include_user_compiled_css', 10);



/* ----------------------------------------------------------------------------
 * front end javascript files
 */
add_action('wp_enqueue_scripts', 'load_front_js');
function load_front_js() {
	$td_deploy_mode = TD_DEPLOY_MODE;

	//switch the deploy mode to demo if we have tagDiv speed booster
	if (defined('TD_SPEED_BOOSTER')) {
		$td_deploy_mode = 'demo';
	}


	switch ($td_deploy_mode) {
		default: //deploy
			wp_enqueue_script('td-site', td_global::$get_template_directory_uri . '/js/tagdiv_theme.js', array('jquery'), TD_THEME_VERSION, true);
			break;

		case 'demo':
			wp_enqueue_script('td-site-min', td_global::$get_template_directory_uri . '/js/tagdiv_theme.min.js', array('jquery'), TD_THEME_VERSION, true);
			break;

		case 'dev':
			// dev version - load each file separately
			$last_js_file_id = '';
			foreach (td_global::$js_files as $js_file_id => $js_file) {
				if ($last_js_file_id == '') {
					wp_enqueue_script($js_file_id, td_global::$get_template_directory_uri . $js_file, array('jquery'), TD_THEME_VERSION, true); //first, load it with jQuery dependency
				} else {
					wp_enqueue_script($js_file_id, td_global::$get_template_directory_uri . $js_file, array($last_js_file_id), TD_THEME_VERSION, true);  //not first - load with the last file dependency
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
	$td_protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style('google-font-ubuntu', $td_protocol . '://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&amp;subset=latin,cyrillic-ext,greek-ext,greek,latin-ext,cyrillic'); //used on content
	if (TD_DEPLOY_MODE == 'dev') {
		wp_enqueue_style('td-wp-admin-td-panel-2', td_global::$get_template_directory_uri . '/td_less_style.css.php?part=wp-admin.css', false, TD_THEME_VERSION, 'all' );
	} else {
		wp_enqueue_style('td-wp-admin-td-panel-2', td_global::$get_template_directory_uri . '/includes/wp-booster/wp-admin/css/wp-admin.css', false, TD_THEME_VERSION, 'all' );
	}


	//load the colorpicker
	wp_enqueue_style( 'wp-color-picker' );
}




/* ----------------------------------------------------------------------------
 * farbtastic color picker CSS and JS for wp-admin / backend - loaded only in the widgets screen. Is used by our widget builder!
 */
function td_on_admin_print_scripts_farbtastic() {
	wp_enqueue_script('farbtastic');
}
function td_on_admin_print_styles_farbtastic() {
	wp_enqueue_style('farbtastic');
}
add_action('admin_print_scripts-widgets.php', 'td_on_admin_print_scripts_farbtastic');
add_action('admin_print_styles-widgets.php', 'td_on_admin_print_styles_farbtastic');




/* ----------------------------------------------------------------------------
 * js for wp-admin / backend   admin js - we use this strange thing to make sure that our scripts are depended on each other
 * and appear one after another exactly like we add them in td_global.php
 */
add_action('admin_enqueue_scripts', 'load_wp_admin_js');
function load_wp_admin_js() {


	$current_page_slug = '';
	if (isset($_GET['page'])) {
		$current_page_slug = $_GET['page'];
	}


	// dev version - load each file separately
	$last_js_file_id = '';
	foreach (td_global::$js_files_for_wp_admin as $js_file_id => $js_file_params) {

		// skip a file if it has custom page_slugs
		if (!empty($js_file_params['show_only_on_page_slugs']) and !in_array($current_page_slug, $js_file_params['show_only_on_page_slugs'])) {
			continue;
		}

		if ($last_js_file_id == '') {
			wp_enqueue_script($js_file_id, td_global::$get_template_directory_uri . $js_file_params['url'], array('jquery', 'wp-color-picker'), TD_THEME_VERSION, false); //first, load it with jQuery dependency
		} else {
			wp_enqueue_script($js_file_id, td_global::$get_template_directory_uri . $js_file_params['url'], array($last_js_file_id), TD_THEME_VERSION, false);  //not first - load with the last file dependency
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
	if (TD_DEPLOY_MODE == 'dev') {
		// we need the full url here due to a WP strange s*it with ?queries
		add_editor_style(get_stylesheet_directory_uri() . '/td_less_style.css.php?part=editor-style');
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
	echo '<script src="' . td_global::$http_or_https . '://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
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
add_filter('the_content_more_link', 'td_remove_more_link_scroll');
function td_remove_more_link_scroll($link) {
	$link = preg_replace('|#more-[0-9]+|', '', $link);
	$link = '<div class="more-link-wrap">' . $link . '</div>';
	return $link;
}




/* ----------------------------------------------------------------------------
 *   TagDiv WordPress booster init
 */

td_init_booster();
function td_init_booster() {

	global $content_width;

	// content width - this is overwritten in post
	if (!isset($content_width)) {
		$content_width = 640;
	}


	/* ----------------------------------------------------------------------------
	 * Add lazy shortcodes of the registered blocks
	 */
	foreach (td_api_block::get_all() as $block_settings_key => $block_settings_value) {
		td_global_blocks::add_lazy_shortcode($block_settings_key);
	}


	/* ----------------------------------------------------------------------------
	* register the default sidebars + dynamic ones
	*/
	register_sidebar(array(
		'name'=> TD_THEME_NAME . ' default',
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
	$currentSidebars = td_util::get_option('sidebars');

	//if we have user made sidebars, register them in wp
	if (!empty($currentSidebars)) {
		foreach ($currentSidebars as $sidebar) {
			register_sidebar(array(
				'name' => $sidebar,
				'id' => 'td-' . td_util::sidebar_name_to_id($sidebar),
				'before_widget' => '<aside class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<div class="block-title"><span>',
				'after_title' => '</span></div>',
			));
		} //end foreach
	}

}






add_filter('redirect_canonical', 'td_fix_wp_441_pagination', 10, 2);
function td_fix_wp_441_pagination($redirect_url, $requested_url) {
	global $wp_query;

	if (is_page() && !is_feed() && isset($wp_query->queried_object) && get_query_var('page') && get_page_template_slug($wp_query->queried_object->ID) == 'page-pagebuilder-latest.php') {
		return false;
	}

	return $redirect_url;
}
