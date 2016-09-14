<?php
/**
 * Created by ra on 2/13/2015.
 */


/**
 * The theme's block template api, usable via the tagdiv_global_after hook
 * Class tagdiv_api_block static block api
 */
class Tagdiv_API_Block_Template extends Tagdiv_API_Base{

    /**
     * This method to register a new block
     *
     * @param $id string The block template id. It must be unique
     * @param $params_array array The block template array
     *
     *      $params_array = array(
     *          'file' => '',           - Where we can find the shortcode class
     *      )
     *
     * @throws ErrorException new exception, fatal error if the $id already exists
     */
    static function add($id, $params_array) {
        parent::add_component(__CLASS__, $id, $params_array);
    }


	static function update($id, $params_array) {
		parent::update_component(__CLASS__, $id, $params_array);
	}


    static function get_all() {
        return parent::get_all_components_metadata(__CLASS__);
    }
}

