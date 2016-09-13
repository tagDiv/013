<?php
/**
 * Created by ra.
 * Date: 9/13/2016
 */



/**
 * speed booster v 3.0 hooks - prepare the framework for the theme
 * is also used by td_deploy - that's why it's a static class
 * Class td_wp_booster_hooks
 */
class td_config {


	/**
	 * setup the global theme specific variables
	 * @depends td_global
	 */
	static function on_td_global_after_config() {

		/**
		 * modules list
		 */
		td_api_module::add('td_module_1',
			array(
				'file' => td_global::$get_template_directory . '/includes/modules/td_module_1.php',
				'text' => 'Module 1',
				'img' => td_global::$get_template_directory_uri . '/images/panel/modules/td_module_1.png',
				'used_on_blocks' => array('td_block_3'),
				'excerpt_title' => 12,
				'excerpt_content' => '',
				'enabled_on_more_articles_box' => true,
				'enabled_on_loops' => true,
				'uses_columns' => true,
				'category_label' => true,
				'class' => 'td_module_wrap td-animation-stack',
				'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
			)
		);


		/**
		 * the blocks
		 */
		td_api_block::add('td_block_1',
			array(
				'map_in_visual_composer' => true,
				"name" => 'Block 1',
				"base" => 'td_block_1',
				"class" => 'td_block_1',
				"controls" => "full",
				"category" => 'Blocks',
				'icon' => 'icon-pagebuilder-td_block_1',
				'file' => td_global::$get_template_directory . '/includes/shortcodes/td_block_1.php',
//				"params" => array_merge(
//					self::get_map_block_general_array(),
//					self::get_map_filter_array(),
//					self::get_map_block_ajax_filter_array(),
//					self::get_map_block_pagination_array()
//				)
			)
		);



		/**
		 * block templates
		 */
		td_api_block_template::add('td_block_template_1',
			array (
				'file' => td_global::$get_template_directory . '/includes/block_templates/td_block_template_1.php',
			)
		);



		td_api_thumb::add('td_300x220',
			array(
				'name' => 'td_300x220',
				'width' => 300,
				'height' => 220,
				'crop' => array('center', 'top'),
				'post_format_icon_size' => 'normal',
				'used_on' => array(
					'Module 1', 'Module 2'
				)
			)
		);

	}
}
