<?php
/**
 * Created by ra.
 * Date: 9/13/2016
 */



/**
 * speed booster v 3.0 hooks - prepare the framework for the theme
 * is also used by tagdiv_deploy - that's why it's a static class
 * Class tagdiv_wp_booster_hooks
 */
class Tagdiv_Config {


	/**
	 * setup the global theme specific variables
	 * @depends Tagdiv_Global
	 */
	static function on_tagdiv_global_after_config() {

		/**
		 * modules list
		 */
		Tagdiv_API_Module::add('tagdiv_module_1',
			array(
				'file' => Tagdiv_Global::$get_template_directory . '/includes/modules/class-tagdiv-module-1.php',
				'text' => 'Module 1',
				'img' => Tagdiv_Global::$get_template_directory_uri . '/images/panel/modules/tagdiv_module_1.png',
				'used_on_blocks' => array('tagdiv_block_3'),
				'excerpt_title' => 12,
				'excerpt_content' => '',
				'enabled_on_more_articles_box' => true,
				'enabled_on_loops' => true,
				'uses_columns' => true,
				'category_label' => true,
				'class' => 'tagdiv_module_wrap td-animation-stack',
				'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
			)
		);


		/**
		 * the blocks
		 */
		Tagdiv_API_Block::add('tagdiv_block_1',
			array(
				'map_in_visual_composer' => true,
				"name" => 'Block 1',
				"base" => 'tagdiv_block_1',
				"class" => 'tagdiv_block_1',
				"controls" => "full",
				"category" => 'Blocks',
				'icon' => 'icon-pagebuilder-tagdiv_block_1',
				'file' => Tagdiv_Global::$get_template_directory . '/includes/shortcodes/class-tagdiv-block-1.php',
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
		Tagdiv_API_Block_Template::add('tagdiv_block_template_1',
			array (
				'file' => Tagdiv_Global::$get_template_directory . '/includes/block-templates/class-tagdiv-block-template.php',
			)
		);



		Tagdiv_API_Thumb::add('tagdiv_300x220',
			array(
				'name' => 'tagdiv_300x220',
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
