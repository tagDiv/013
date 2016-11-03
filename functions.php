<?php

// load theme configuration
require_once( 'includes/class-tagdiv-config.php' );
add_action( 'tagdiv_global_after', array( 'Tagdiv_Config', 'on_tagdiv_global_after_config' ), 9 );

require_once( 'includes/wp-booster/wp-booster-functions.php' );

/**
 * Custom template tags for this theme.
 */
require_once( 'includes/template-tags.php' );


/**
 * Customizer additions.
 */
require_once( 'includes/customizer.php' );
