<?php
/**
 * Created by ra.
 * Date: 9/13/2016
 */

define( 'TAGDIV_THEME_NAME', '013' );
define( 'TAGDIV_THEME_VERSION', '__td_deploy_version__' );
define( 'TAGDIV_FEATURED_CAT', 'Featured' );



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
		Tagdiv_API_Module::add( 'Tagdiv_Module_1',
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
				'class' => 'tagdiv-module-wrap td-animation-stack',
				'group' => '' // '' - main theme, 'mob' - mobile theme, 'woo' - woo theme
			)
		);


		/**
		 * the blocks
		 */
		Tagdiv_API_Block::add( 'Tagdiv_Block_1',
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

		Tagdiv_API_Block::add('Tagdiv_Block_Image_Box',
			array(
				'map_in_visual_composer' => true,
				"name" => 'Image box',
				"base" => "tagdiv_block_image_box",
				"class" => "tagdiv-block-image-box",
				"controls" => "full",
				"category" => 'Blocks',
				'icon' => 'icon-pagebuilder-td_block_image_box',
				'file' => Tagdiv_Global::$get_template_directory . '/includes/shortcodes/class-tagdiv-block-image-box.php',
				/*"params" => array(
					array(
						"param_name" => "custom_title",
						"type" => "textfield",
						"value" => 'Block title',
						"heading" => "Block title",
						"description" => "Custom title for this block",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig"
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => 'Title text color',
						"param_name" => "header_text_color",
						"value" => '', //Default Red color
						"description" => 'Optional - Choose a custom title text color for this block'
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => 'Title background color',
						"param_name" => "header_color",
						"value" => '', //Default Red color
						"description" => 'Optional - Choose a custom title background color for this block'
					),
					array(
						"param_name" => "separator",
						"type" => "horizontal_separator",
						"value" => "",
						"class" => ""
					),
					array(
						"param_name" => "height",
						"type" => "textfield",
						"value" => '',
						"heading" => 'Image height',
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-small"
					),
					array(
						"param_name" => "gap",
						"type" => "textfield",
						"value" => '',
						"heading" => 'Image gap',
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-small"
					),
					array(
						"param_name" => "alignment",
						"type" => "dropdown",
						"value" => array(
							'Top' => 'top',
							'Center' => '',
							'Bottom' => 'bottom'
						),
						"heading" => 'Image alignment',
						"description" => "",
						"holder" => "div",
						"class" => "tdc-dropdown-big",
					),
					array(
						"param_name" => "display",
						"type" => "dropdown",
						"value" => array(
							'Vertical' => '',
							'Horizontal' => 'horizontal'
						),
						"heading" => 'Layout',
						"description" => "",
						"holder" => "div",
						"class" => "tdc-dropdown-big",
					),
					array(
						"param_name" => "style",
						"type" => "dropdown",
						"value" => array(
							'1 - With border' => '',
							'2 - White box' => 'style-2'
						),
						"heading" => 'Box style',
						"description" => "",
						"holder" => "div",
						"class" => "tdc-dropdown-big",
					),
					array(
						"param_name" => "separator",
						"type" => "horizontal_separator",
						"value" => "",
						"class" => ""
					),
					array(
						'param_name' => 'el_class',
						'type' => 'textfield',
						'value' => '',
						'heading' => 'Extra class',
						'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS',
						'class' => 'tdc-textfield-extrabig'
					),
					array(
						"param_name" => "image_item0",
						"type" => "image",
						"value" => '',
						"heading" => "Image 1",
						"description" => "",
						"holder" => "div",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "image_title_item0",
						"type" => "textfield",
						"value" => '',
						"heading" => "Custom title",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig",
						"group" => 'Images'
					),
					array(
						"param_name" => "custom_url_item0",
						"type" => "textfield",
						"value" => '',
						"heading" => "Custom url",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig",
						"group" => 'Images'
					),
					array(
						"param_name" => "open_in_new_window_item0",
						"type" => "checkbox",
						"value" => '',
						"heading" => "Open in new window",
						"description" => "",
						"holder" => "div",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "horizontal_separator_item1",
						"type" => "horizontal_separator",
						"value" => "",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "image_item1",
						"type" => "image",
						"value" => '',
						"heading" => "Image 2",
						"description" => "",
						"holder" => "div",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "image_title_item1",
						"type" => "textfield",
						"value" => '',
						"heading" => "Custom title",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig",
						"group" => 'Images'
					),
					array(
						"param_name" => "custom_url_item1",
						"type" => "textfield",
						"value" => '',
						"heading" => "Custom url",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig",
						"group" => 'Images'
					),
					array(
						"param_name" => "open_in_new_window_item1",
						"type" => "checkbox",
						"value" => '',
						"heading" => "Open in new window",
						"description" => "",
						"holder" => "div",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "horizontal_separator_item2",
						"type" => "horizontal_separator",
						"value" => "",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "image_item2",
						"type" => "image",
						"value" => '',
						"heading" => "Image 3",
						"description" => "",
						"holder" => "div",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "image_title_item2",
						"type" => "textfield",
						"value" => '',
						"heading" => "Custom title",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig",
						"group" => 'Images'
					),
					array(
						"param_name" => "custom_url_item2",
						"type" => "textfield",
						"value" => '',
						"heading" => "Custom url",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig",
						"group" => 'Images'
					),
					array(
						"param_name" => "open_in_new_window_item2",
						"type" => "checkbox",
						"value" => '',
						"heading" => "Open in new window",
						"description" => "",
						"holder" => "div",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "horizontal_separator_item3",
						"type" => "horizontal_separator",
						"value" => "",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "image_item3",
						"type" => "image",
						"value" => '',
						"heading" => "Image 4",
						"description" => "",
						"holder" => "div",
						"class" => "",
						"group" => 'Images'
					),
					array(
						"param_name" => "image_title_item3",
						"type" => "textfield",
						"value" => '',
						"heading" => "Custom title",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig",
						"group" => 'Images'
					),
					array(
						"param_name" => "custom_url_item3",
						"type" => "textfield",
						"value" => '',
						"heading" => "Custom url",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-extrabig",
						"group" => 'Images'
					),
					array(
						"param_name" => "open_in_new_window_item4",
						"type" => "checkbox",
						"value" => '',
						"heading" => "Open in new window",
						"description" => "",
						"holder" => "div",
						"class" => "",
						"group" => 'Images'
					),
					array (
						'param_name' => 'css',
						'value' => '',
						'type' => 'css_editor',
						'heading' => 'Css',
						'group' => 'Design options',
					)
				)*/
			)
		);



		/**
		 * block templates
		 */
		Tagdiv_API_Block_Template::add( 'Tagdiv_Block_Template_1',
			array (
				'file' => Tagdiv_Global::$get_template_directory . '/includes/block-templates/class-tagdiv-block-template.php',
			)
		);

//		Tagdiv_API_Block_Template::add('tagdiv_block_template_1',
//			array (
//				'file' => Tagdiv_Global::$get_template_directory . '/includes/block-templates/class-tagdiv-block-template.php',
//			)
//		);



		Tagdiv_API_Thumb::add( 'td_300x220',
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

		Tagdiv_API_Thumb::add('td_640x0',
			array(
				'name' => 'td_640x0',
				'width' => 640,
				'height' => 0,
				'crop' => array('center', 'top'),
				'post_format_icon_size' => 'normal',
				'used_on' => array(
					'Post template default'
				)
			)
		);

	}
}
