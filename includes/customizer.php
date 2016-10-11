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

}
add_action( 'customize_register', 'tagdiv_customize_register', 11 );

