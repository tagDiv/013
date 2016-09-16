<?php
/**
 * Created by ra on 2/13/2015.
 */


/**
 * The theme's module api, usable via the tagdiv_global_after hook
 * Class tagdiv_api_module static module api
 */
class Tagdiv_API_Module extends Tagdiv_API_Base {

	/**
	 * This method to register a new module
	 *
	 * @param $id           string The module id. It must be unique
	 * @param $params_array array The module_parameter array
	 *
	 *      $params_array = array (
	 *          'file' => '',                               - [string] the path to the module class
	 *          'text' => '',                               - [string] module name text used in the theme panel
	 *          'img' => '',                                - [string] the path to the image icon
	 *          'used_on_blocks' => array(),                - [array of strings] block names where this module is used or leave blank if it's used internally (ex. it's not used on any category)
	 *          'excerpt_title' => '',                      - [int] leave empty '' if you don't want a setting in the panel -> excerpts for this module
	 *          'excerpt_content' => '',                    - [int] leave empty ''  ----||----
	 *          'enabled_on_more_articles_box' => ,         - [boolean] show the module in the more articles box in panel -> post settings -> more articles box
	 *          'enabled_on_loops' => ,                     - [boolean] show the module in panel on loops
	 *          'uses_columns' => ,                         - [boolean] if the module uses columns on the page template + loop (if the modules has columns, enable this)
	 *          'category_label' =>                         - [boolean] show the module in panel -> block_settings -> category label ?
	 *      )
	 *
	 * @throws ErrorException new exception, fatal error if the $id already exists
	 */
	static function add( $module_id, $params_array = '' ) {

		// put a default image if we don't have any image, useful when developing a new module
		if ( empty( $params_array['img'] ) ) {
			$params_array['img'] = Tagdiv_Global::$get_template_directory_uri . '/includes/wp_booster/wp-admin/images/panel/panel-placeholders/no_module_image.png';
		}

		parent::add_component( __CLASS__, $module_id, $params_array );
	}

	static function update( $module_id, $params_array = '' ) {
		parent::update_component( __CLASS__, $module_id, $params_array );
	}


	/**
	 * This method gets the value for the ('tagdiv_api_module') key in the main settings array of the theme.
	 * It filters the settings using the 'group' key, to allow extracting only the modules info for the desired theme.
	 * The parameter $group could have the following values '' (the main theme), 'mob' (the mobile theme), 'woo' (the woo theme), etc.
	 *
	 * @param string $group The group of the module.
	 *
	 * @return mixed array The value set for the 'tagdiv_api_module' in the main settings array of the theme
	 */
	static function get_all( $group = '' ) {
		$components = parent::get_all_components_metadata( __CLASS__ );
		foreach ( $components as $component_key => $component_value ) {
			if ( array_key_exists( 'group', $component_value ) && $component_value['group'] !== $group ) {
				unset( $components[ $component_key ] );
			}
		}

		return $components;
	}


	/**
	 * This method is an internal helper function used to check 'excerpt_title' property of a module
	 *
	 * @internal
	 *
	 * @param $module_id string Unique module id
	 *
	 * @return bool True if the 'excerpt_title' property is set, false otherwise
	 */
	static function _helper_check_excerpt_title( $module_id ) {
		$module_settings = self::get_by_id( $module_id );

		if ( isset( $module_settings ) && ! empty( $module_settings['excerpt_title'] ) ) {
			return true;
		}

		return false;
	}


	/**
	 * This method is an internal helper function used to check 'excerpt_content' property of a module
	 *
	 * @internal
	 *
	 * @param $module_id string Unique module id
	 *
	 * @return bool True if the 'excerpt_content' property is set, false otherwise
	 */

	static function _helper_check_excerpt_content( $module_id ) {
		$module_settings = self::get_by_id( $module_id );

		if ( isset( $module_settings ) && ! empty( $module_settings['excerpt_content'] ) ) {
			return true;
		}

		return false;
	}


	/**
	 * FOR LEGACY MODULES that have names like tagdiv_module_x (where x is a number)
	 *  - converts module classes to module id's for loop settings. tagdiv_module_2 -> 2 (we store the 2 in the database)
	 *
	 * @param $module_class
	 *
	 * @return integer id of the module tagdiv_module_2 returns 2
	 */
	static function _helper_get_module_loop_id( $module_class ) {

		// DEAL WITH LEGACY MODULE NAMES
		// if we get a string, try to trim tagdiv_module_ and see if we are left with a number
		$trim_result = str_replace( 'tagdiv_module_', '', $module_class );
		if ( is_numeric( $trim_result ) ) {
			return filter_var( $module_class, FILTER_SANITIZE_NUMBER_INT );
		}


		return $module_class;
	}


	/**
	 * WARNING (2 now 2015): we tried to refactor this multiple times. It is not worth it because all the theme including the panel
	 * have to work with the new and old settings - resulting in added complexity without any real benefits
	 *
	 * @param $module_class
	 *
	 * @return string
	 */
	static function _helper_get_module_name_from_class( $module_class ) {
		return str_replace( 'tagdiv_', '', $module_class );
	}


	/**
	 * FOR LEGACY MODULES that have names like tagdiv_module_x (where x is a number)
	 *  - Gets the class from a loop id that is stored in the database. ex: 2 -> tagdiv_module_2
	 *
	 * @param $module_id
	 *
	 * @return string
	 */
	static function _helper_get_module_class_from_loop_id( $module_id ) {
		// DEAL WITH LEGACY MODULE NAMES where we only have the id in the database, we can't have a module that is
		// all numbers because php dosn't allow classes like that
		if ( is_numeric( $module_id ) ) {
			return 'tagdiv_module_' . $module_id;
		}

		return $module_id;
	}
}


