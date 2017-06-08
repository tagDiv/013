<?php
/**
 * MeisterMag Customizer functionality
 *
 * @since MeisterMag 1.0
 */

if ( ! function_exists( 'tagdiv_customize_register' ) ) {
	/**
	 * add theme customizer options/functionality
	 * @param $wp_customize
	 */
	function tagdiv_customize_register( $wp_customize ) {

		/* Theme Options Section */
		$wp_customize->add_section( 'tagdiv_options_section',
			array(
				'title'          => __( 'MesiterMag Theme Options', 'meistermag' ),
				'priority'       => 1,
				'capability' 	 => 'edit_theme_options',
				'description' 	 => __( 'Allows you to customize the footer settings for MesiterMag Theme.', 'meistermag'),
			)
		);

		/* Theme Footer Logo */
		$wp_customize->add_setting( 'tagdiv_theme_options[tagdiv_footer_logo]',
			array(
				'capability' 		=> 'edit_theme_options',
				'theme_supports' 	=> array( 'custom-logo' ),
				'sanitize_callback' => 'tagdiv_sanitize_image',
			)
		);

		/* Theme Footer Logo uploader */
		$tagdiv_custom_logo_args = get_theme_support( 'custom-logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tagdiv_footer_logo',
				array(
					'label'    	  	=> __( 'Footer Logo', 'meistermag' ),
					'description' 	=> __( 'Upload the logo you want to use in the Footer section.', 'meistermag' ),
					'section'  	  	=> 'tagdiv_options_section',
					'priority'    	=> 1,
					'settings' 	  	=> 'tagdiv_theme_options[tagdiv_footer_logo]',
					'height'        => $tagdiv_custom_logo_args[0]['height'],
					'width'         => $tagdiv_custom_logo_args[0]['width'],
					'flex_height'   => $tagdiv_custom_logo_args[0]['flex-height'],
					'flex_width'    => $tagdiv_custom_logo_args[0]['flex-width'],
					'button_labels' =>
						array(
							'select'       => __( 'Select logo', 'meistermag' ),
							'change'       => __( 'Change logo', 'meistermag' ),
							'remove'       => __( 'Remove', 'meistermag' ),
							'default'      => __( 'Default', 'meistermag' ),
							'placeholder'  => __( 'No logo selected', 'meistermag' ),
							'frame_title'  => __( 'Select logo', 'meistermag' ),
							'frame_button' => __( 'Choose logo', 'meistermag' ),
						)
				)
			)
		);

		/* Theme Subfooter Copyright Text */
		$wp_customize->add_setting( 'tagdiv_theme_options[tagdiv_subfooter_copyright]',
			array(
				'capability' 		=> 'edit_theme_options',
				'default' 			=> __( 'Your Copyright Text', 'meistermag' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( 'tagdiv_subfooter_copyright',
			array(
				'label'      	=> __( 'Sub-Footer Copyright Text', 'meistermag' ),
				'description' 	=> __( 'Add here the sub-footer copyright text', 'meistermag' ),
				'section'    	=> 'tagdiv_options_section',
				'priority'      => 4,
				'type' 		  	=> 'textarea',
				'settings' 		=> 'tagdiv_theme_options[tagdiv_subfooter_copyright]',
			)
		);

		/* Theme Subfooter Copyright Symbol */
		$wp_customize->add_setting( 'tagdiv_theme_options[tagdiv_subfooter_copyright_symbol]',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'           => '1',
				'sanitize_callback' => 'tagdiv_sanitize_checkbox',
			)
		);

		$wp_customize->add_control( 'tagdiv_subfooter_copyright_symbol',
			array(
				'label'      	=> __( 'Copyright Symbol', 'meistermag' ),
				'description' 	=> __( 'Show/Hide the footer copyright symbol', 'meistermag' ),
				'section'    	=> 'tagdiv_options_section',
				'priority'      => 5,
				'type' 		  	=> 'checkbox',
				'settings' 		=> 'tagdiv_theme_options[tagdiv_subfooter_copyright_symbol]',
			)
		);

		/* Theme Home Block Section Title Settings */
		$wp_customize->add_setting( 'tagdiv_theme_options[tagdiv_block_section_title]',
			array(
				'capability' 	 	=> 'edit_theme_options',
				'default'           => __( 'Block Title', 'meistermag' ),
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control( 'tagdiv_block_section_title',
			array(
				'label'      	=> __( 'Homepage Top Block Title', 'meistermag' ),
				'description' 	=> __( 'Use this option to set the theme homepage top block title', 'meistermag' ),
				'section'  	  	=> 'tagdiv_options_section',
				'priority'    	=> 6,
				'settings' 	  	=> 'tagdiv_theme_options[tagdiv_block_section_title]',
			)
		);

		/* Theme Latest Posts Section Title Settings */
		$wp_customize->add_setting( 'tagdiv_theme_options[tagdiv_latest_section_title]',
			array(
				'capability' 	 	=> 'edit_theme_options',
				'default'           => __( 'Latest Articles', 'meistermag' ),
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control( 'tagdiv_latest_section_title',
			array(
				'label'      	=> __( 'Homepage Latest Articles Title', 'meistermag' ),
				'description' 	=> __( 'Use this option to set the theme homepage latest articles section title', 'meistermag' ),
				'section'  	  	=> 'tagdiv_options_section',
				'priority'    	=> 7,
				'settings' 	  	=> 'tagdiv_theme_options[tagdiv_latest_section_title]',
			)
		);

	}
}
add_action( 'customize_register', 'tagdiv_customize_register', 11 );