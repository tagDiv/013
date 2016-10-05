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
		'label'    	  	=> __td( 'Footer Logo', 'tdmag' ),
		'description' 	=> __td( 'Upload the logo which will be used on the footer. If you do not set a footer logo, the theme will load the header logo.', 'tdmag' ),
		'section'  	  	=> 'title_tagline',
		'priority'    	=> 10,
		'settings' 	  	=> 'tagdiv_footer_logo',
		'height'        => $custom_logo_args[0]['height'],
		'width'         => $custom_logo_args[0]['width'],
		'flex_height'   => $custom_logo_args[0]['flex-height'],
		'flex_width'    => $custom_logo_args[0]['flex-width'],
	) ) );

	/*
	 * footer site description text
	 */

	$wp_customize->add_setting( 'tagdiv_footer_text', array(
		'default' 	 	=> __td( 'tdmag is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.', 'tdmag' ),
		'type'       	=> 'option',
		'capability' 	=> 'manage_options'
	) );

	$wp_customize->add_control( 'tagdiv_footer_text', array(
		'label'       	=> __td( 'Footer Text', 'tdmag' ),
		'description' 	=> __td( 'Write here your footer text', 'tdmag' ),
		'section'     	=> 'title_tagline',
		'priority'    	=> 10,
		'type' 		  	=> 'textarea',
		'settings' 	  	=> 'tagdiv_footer_text',
	) );

	/*
	 * footer contact email address
	 */

	$wp_customize->add_setting( 'tagdiv_footer_email', array(
		'default' 		=> __td( 'contact@yoursite.com', 'tdmag' ),
		'type'       	=> 'option',
		'capability' 	=> 'manage_options'
	) );

	$wp_customize->add_control( 'tagdiv_footer_email', array(
		'label'      	=> __td( 'Footer Contact Email', 'tdmag' ),
		'description' 	=> __td( 'Add here your footer contact email adress', 'tdmag' ),
		'section'    	=> 'title_tagline',
		'priority'      => 11,
		'settings' 		=> 'tagdiv_footer_email',
	) );

	/*
	 * subfooter copyright text
	 */

	$wp_customize->add_setting( 'tagdiv_subfooter_copyright', array(
		'default' 		=> __td( '2016 TdMag Theme - All rights reserved', 'tdmag' ),
		'type'       	=> 'option',
		'capability' 	=> 'manage_options'
	) );

	$wp_customize->add_control( 'tagdiv_subfooter_copyright', array(
		'label'      	=> __td( 'Sub-Footer Copyright Text', 'tdmag' ),
		'description' 	=> __td( 'Set the subfooter copyright text', 'tdmag' ),
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
		'label'      	=> __td( 'Copyright Symbol', 'tdmag' ),
		'description' 	=> __td( 'Show or hide the footer copyright symbol', 'tdmag' ),
		'section'    	=> 'title_tagline',
		'priority'      => 13,
		'type' 		  	=> 'checkbox',
		'settings' 		=> 'tagdiv_subfooter_copyright_symbol',
	) );

}
add_action( 'customize_register', 'tagdiv_customize_register', 11 );

