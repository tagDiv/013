<?php

class Tagdiv_Global_Blocks {
	private static $global_instances = array();

	private static $global_block_instances = array();


	/**
	 * @param $block_id string keeps a reference of the block
	 */
	static function add_block_id ( $block_id ) {
		self::$global_block_instances[] = $block_id;
	}

	static function get_instance( $block_id ) {

		if ( isset( self::$global_instances[ $block_id ] ) ) {

			return self::$global_instances[ $block_id ];
		} else if ( in_array( $block_id, self::$global_block_instances ) ) {

			$new_instance                        = new $block_id();
			self::$global_instances[ $block_id ] = $new_instance;

			return $new_instance;
		} else {
			Tagdiv_Util::error( __FILE__, 'get_instance - was called with a $block_id that does not exists: ' . $block_id );

			/**
			 * return a fake new instance of tagdiv_block - so that we have the render() method for decoupling
			 */
			return new Tagdiv_Block();
		}
	}

}