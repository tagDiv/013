<?php
/**
 * This is the config file for the theme.
 */

define( 'TAGDIV_THEME_NAME', 'tdmag' );


class Tagdiv_Config {

	/**
	 * setup the global theme specific variables
	 */
	static function on_tagdiv_global_after_config() {

		/**
		 * The theme module
		 */

		Tagdiv_API_Module::add( 'Tagdiv_Module_1',
			array(
				'file' 			 => get_template_directory() . '/includes/modules/class-tagdiv-module-1.php',
				'text' 			 => 'Module 1',
				'used_on_blocks' => array('tagdiv_block_1'),
				'class' 		 => 'tagdiv-module-wrap',
			)
		);


		/**
		 * The theme blocks
		 */

		Tagdiv_API_Block::add( 'Tagdiv_Block_1',
			array(
				"file" 	   => get_template_directory() . '/includes/shortcodes/class-tagdiv-block-1.php',
				"name" 	   => 'Block 1',
				"class"    => 'tagdiv_block_1',
				"category" => 'Blocks',
			)
		);

		Tagdiv_API_Block::add( 'Tagdiv_Block_Image_Box',
			array(
				"file"     => get_template_directory() . '/includes/shortcodes/class-tagdiv-block-image-box.php',
				"name" 	   => 'Image box',
				"class"    => "tagdiv-block-image-box",
				"category" => 'Blocks',
			)
		);


		/**
		 * The thumbs used by the theme
		 */

		Tagdiv_API_Thumb::add( 'td_300x220',
			array(
				'name' => 'td_300x220',
				'width' => 300,
				'height' => 220,
				'crop' => array('center', 'top'),
				'used_on' => array(
					'Module 1', 'Module 2'
				)
			)
		);

		Tagdiv_API_Thumb::add( 'td_640x0',
			array(
				'name' => 'td_640x0',
				'width' => 640,
				'height' => 0,
				'crop' => array('center', 'top'),
				'used_on' => array(
					'Post template default'
				)
			)
		);

	}
}
