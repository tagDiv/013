<?php
/**
 * Class td_menu
 */

// the menu

class td_menu {


    function __construct() {
        add_action( 'init', array($this, 'hook_init'));
    }



    function hook_init() {
        register_nav_menus(
            array(
                'header-menu' => 'Header Menu (main)',
                'footer-menu' => 'Sub Footer Menu'
            )
        );
    }



}

new td_menu();