<?php


require_once 'deploy-mode.php';

// load the config
require_once('includes/class-tagdiv-config.php');
add_action('tagdiv_global_after', array('Tagdiv_Config', 'on_tagdiv_global_after_config'), 9); //we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10


require_once('includes/wp-booster/wp-booster-transition.php');
require_once('includes/wp-booster/wp-booster-functions.php');

require_once('includes/tagdiv_css_generator.php');




function __td($tagdiv_string, $tagdiv_domain = '') {
	return $tagdiv_string;
}

