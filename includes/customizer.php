<?php
/**
 * TAGDIV_THEME_NAME Customizer functionality
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

function tagdiv_customize_register( $wp_customize ) {

	/* Site Identity */

	/*
	 * footer logo uploader
	 */

	$wp_customize->add_setting( 'tagdiv_footer_logo', array(
		'theme_supports' => array( 'custom-logo' )
	) );

	$custom_logo_args = get_theme_support( 'custom-logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tagdiv_footer_logo', array(
		'label'    	  	=> __( 'Footer Logo', 'tdmag' ),
		'description' 	=> __( 'Upload the logo you want to use in the footer. If you do not set a footer logo, the theme will load the header logo instead.', 'tdmag' ),
		'section'  	  	=> 'title_tagline',
		'priority'    	=> 10,
		'settings' 	  	=> 'tagdiv_footer_logo',
		'height'        => $custom_logo_args[0]['height'],
		'width'         => $custom_logo_args[0]['width'],
		'flex_height'   => $custom_logo_args[0]['flex-height'],
		'flex_width'    => $custom_logo_args[0]['flex-width'],
		'button_labels' => array(
			'select'       => __( 'Select logo', 'tdmag' ),
			'change'       => __( 'Change logo', 'tdmag' ),
			'remove'       => __( 'Remove', 'tdmag' ),
			'default'      => __( 'Default', 'tdmag' ),
			'placeholder'  => __( 'No logo selected', 'tdmag' ),
			'frame_title'  => __( 'Select logo', 'tdmag' ),
			'frame_button' => __( 'Choose logo', 'tdmag' ),
		),
	) ) );

	/*
	 * footer site description text
	 */

	$wp_customize->add_setting( 'tagdiv_footer_text', array(
		'default' 	 	=> __( 'TAGDIV_THEME_NAME is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.', 'tdmag' ),
		'type'       	=> 'option',
		'capability' 	=> 'manage_options'
	) );

	$wp_customize->add_control( 'tagdiv_footer_text', array(
		'label'       	=> __( 'Footer Text', 'tdmag' ),
		'description' 	=> __( 'Write here your footer text', 'tdmag' ),
		'section'     	=> 'title_tagline',
		'priority'    	=> 10,
		'type' 		  	=> 'textarea',
		'settings' 	  	=> 'tagdiv_footer_text',
	) );

	/*
	 * footer contact email address
	 */

	$wp_customize->add_setting( 'tagdiv_footer_email', array(
		'default' 		=> __( 'contact@yoursite.com', 'tdmag' ),
		'type'       	=> 'option',
		'capability' 	=> 'manage_options'
	) );

	$wp_customize->add_control( 'tagdiv_footer_email', array(
		'label'      	=> __( 'Footer Contact Email', 'tdmag' ),
		'description' 	=> __( 'Add here your footer contact email address', 'tdmag' ),
		'section'    	=> 'title_tagline',
		'priority'      => 11,
		'settings' 		=> 'tagdiv_footer_email',
	) );

	/*
	 * subfooter copyright text
	 */

	$wp_customize->add_setting( 'tagdiv_subfooter_copyright', array(
		'default' 		=> __( '2016 TAGDIV_THEME_NAME Theme - All rights reserved', 'tdmag' ),
		'type'       	=> 'option',
		'capability' 	=> 'manage_options'
	) );

	$wp_customize->add_control( 'tagdiv_subfooter_copyright', array(
		'label'      	=> __( 'Sub-Footer Copyright Text', 'tdmag' ),
		'description' 	=> __( 'Set the Sub-Footer copyright text', 'tdmag' ),
		'section'    	=> 'title_tagline',
		'priority'      => 12,
		'type' 		  	=> 'textarea',
		'settings' 		=> 'tagdiv_subfooter_copyright',
	) );

	/*
	 * subfooter copyright symbol
	 */

	$wp_customize->add_setting( 'tagdiv_subfooter_copyright_symbol', array(
		'default'           => 1,
		'capability' 	=> 'manage_options'
	) );

	$wp_customize->add_control( 'tagdiv_subfooter_copyright_symbol', array(
		'label'      	=> __( 'Copyright Symbol', 'tdmag' ),
		'description' 	=> __( 'Show or hide the footer copyright symbol', 'tdmag' ),
		'section'    	=> 'title_tagline',
		'priority'      => 13,
		'type' 		  	=> 'checkbox',
		'settings' 		=> 'tagdiv_subfooter_copyright_symbol',
	) );




	/* Front Page > Block Settings section */

	$wp_customize->add_section( 'tagdiv_block_settings_section' , array(
		'title'       => __( 'Blocks Settings','tdmag' ),
		'description' =>  __( 'Use this section to set the TAGDIV_THEME_NAME Homepage Image Block settings','tdmag' ),
		'priority'    => 30,
		'active_callback' => 'is_front_page',
	) );

	/*  ----------------------------------------------------------------------------
    	Image block title
 	*/
	$wp_customize->add_setting( 'tagdiv_block_settings_image_block_title', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_block_title', array(
		'label'      	=> __( 'Image Block Title', 'tdmag' ),
		'description' 	=> __( 'Set the Image Block title', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 1,
		'settings' 	  	=> 'tagdiv_block_settings_image_block_title',
	) );




















	/* Images */

	/*  ----------------------------------------------------------------------------
    	first image
 	*/
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item0', array(
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tagdiv_block_settings_image_item0', array(
		'label'      	=> __( 'Image #1', 'tdmag' ),
		'description' 	=> __( 'Upload the first image to be used in the image block', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 1,
		'settings' 	  	=> 'tagdiv_block_settings_image_item0',
		'button_labels' => array(
			'select'       => __( 'Select img', 'tdmag' ),
			'change'       => __( 'Change img', 'tdmag' ),
			'remove'       => __( 'Remove', 'tdmag' ),
			'default'      => __( 'Default', 'tdmag' ),
			'placeholder'  => __( 'No img selected', 'tdmag' ),
			'frame_title'  => __( 'Select img', 'tdmag' ),
			'frame_button' => __( 'Choose img', 'tdmag' ),
		),
	) ) );

	/* title */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item0_title', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item0_title', array(
		'label'      	=> __( 'Custom title', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 1,
		'settings' 	  	=> 'tagdiv_block_settings_image_item0_title',
	) );

	/* link */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item0_url', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item0_url', array(
		'label'      	=> __( 'Custom URL', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 1,
		'type' 		  	=> 'url',
		'settings' 	  	=> 'tagdiv_block_settings_image_item0_url',
	) );

	/* open in new window option */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item0_url_open', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item0_url_open', array(
		'label'      	=> __( 'Open in new window', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 1,
		'type' 		  	=> 'checkbox',
		'settings' 	  	=> 'tagdiv_block_settings_image_item0_url_open',
	) );

	/*  ----------------------------------------------------------------------------
    	second image
 	*/
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item1', array(
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tagdiv_block_settings_image_item1', array(
		'label'      	=> __( 'Image #2', 'tdmag' ),
		'description' 	=> __( 'Upload the second image to be used in the image block', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 2,
		'settings' 	  	=> 'tagdiv_block_settings_image_item1',
		'button_labels' => array(
			'select'       => __( 'Select img', 'tdmag' ),
			'change'       => __( 'Change img', 'tdmag' ),
			'remove'       => __( 'Remove', 'tdmag' ),
			'default'      => __( 'Default', 'tdmag' ),
			'placeholder'  => __( 'No img selected', 'tdmag' ),
			'frame_title'  => __( 'Select img', 'tdmag' ),
			'frame_button' => __( 'Choose img', 'tdmag' ),
		),
	) ) );

	/* title */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item1_title', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item1_title', array(
		'label'      	=> __( 'Custom title', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 2,
		'settings' 	  	=> 'tagdiv_block_settings_image_item1_title',
	) );

	/* link */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item1_url', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item1_url', array(
		'label'      	=> __( 'Custom URL', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 2,
		'type' 		  	=> 'url',
		'settings' 	  	=> 'tagdiv_block_settings_image_item1_url',
	) );

	/* open in new window option */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item1_url_open', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item1_url_open', array(
		'label'      	=> __( 'Open in new window', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 2,
		'type' 		  	=> 'checkbox',
		'settings' 	  	=> 'tagdiv_block_settings_image_item1_url_open',
	) );

	/*  ----------------------------------------------------------------------------
    	third image
 	*/
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item2', array(
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tagdiv_block_settings_image_item2', array(
		'label'      	=> __( 'Image #3', 'tdmag' ),
		'description' 	=> __( 'Upload the third image to be used in the image block', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 3,
		'settings' 	  	=> 'tagdiv_block_settings_image_item2',
		'button_labels' => array(
			'select'       => __( 'Select img', 'tdmag' ),
			'change'       => __( 'Change img', 'tdmag' ),
			'remove'       => __( 'Remove', 'tdmag' ),
			'default'      => __( 'Default', 'tdmag' ),
			'placeholder'  => __( 'No img selected', 'tdmag' ),
			'frame_title'  => __( 'Select img', 'tdmag' ),
			'frame_button' => __( 'Choose img', 'tdmag' ),
		),
	) ) );

	/* title */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item2_title', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item2_title', array(
		'label'      	=> __( 'Custom title', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 3,
		'settings' 	  	=> 'tagdiv_block_settings_image_item2_title',
	) );

	/* link */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item2_url', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item2_url', array(
		'label'      	=> __( 'Custom URL', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 3,
		'type' 		  	=> 'url',
		'settings' 	  	=> 'tagdiv_block_settings_image_item2_url',
	) );

	/* open in new window option */
	$wp_customize->add_setting( 'tagdiv_block_settings_image_item2_url_open', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_image_item2_url_open', array(
		'label'      	=> __( 'Open in new window', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 3,
		'type' 		  	=> 'checkbox',
		'settings' 	  	=> 'tagdiv_block_settings_image_item2_url_open',
	) );


	/*  ----------------------------------------------------------------------------
    Block I title
 	*/
	$wp_customize->add_setting( 'tagdiv_block_settings_block_1_title', array(
			'type'       	=> 'option',
			'capability' 	=> 'manage_options'
		)
	);

	$wp_customize->add_control( 'tagdiv_block_settings_block_1_title', array(
		'label'      	=> __( 'Block I Title', 'tdmag' ),
		'description' 	=> __( 'Set the Block I title', 'tdmag' ),
		'section'  	  	=> 'tagdiv_block_settings_section',
		'priority'    	=> 4,
		'settings' 	  	=> 'tagdiv_block_settings_block_1_title',
	) );


}
add_action( 'customize_register', 'tagdiv_customize_register', 11 );

