<?php

/**
 * Class Tagdiv_Block - base class for blocks
 */
class Tagdiv_Block {
	var $tagdiv_query; //the query used to rendering the current block

	public $atts = array(); //the block attributes used for rendering the current block

	/**
	 * the base render function. This is called by all the child classes of this class
	 *
	 * @param $atts
	 *
	 * @return string ''
	 */
	function render( $atts ) {

		// All block attributes must be defined here !!!
		// It's easier to maintain and we always have a list of them all
		$this->atts = shortcode_atts( //add defaults (if an att is not in this list, it will be removed! )
			array(
				'limit'                => 5,
				// posts no limit
				'sort'                 => '',
				// posts sorting
				'post_ids'             => '',
				// post id's filter (separated by commas)
				'tag_slug'             => '',
				// tag slug filter (separated by commas)
				'autors_id'            => '',
				// filter by post authors ID
				'installed_post_types' => '',
				// filter by custom post types
				'category_id'          => '',
				// filter by multiple category ids ( multiple category filter )
				'category_ids'         => '',
				// filter by category id ( a single category filter )
				'custom_title'         => '',
				// custom title for the block
				'custom_url'           => '',
				// cusotm ulr for the block title
				'tagdiv_column_number' => '',
				//column number
				'offset'               => '',
				// block posts offset
			),
			$atts
		);

		//by ref do the query
		$this->tagdiv_query = &Tagdiv_Data_Source::get_wp_query( $this->atts );

		return '';
	}


	/**
	 * Used by blocks to generate titles
	 * @return string
	 */
	function get_block_title() {
		$custom_title = $this->atts['custom_title'];
		$custom_url   = $this->atts['custom_url'];

		if ( empty( $custom_title ) ) {
			return '';
		}

		// there is a custom title
		$buffy = '';
		$buffy .= '<h4 class="block-title">';
		if ( ! empty( $custom_url ) ) {
			$buffy .= '<a href="' . esc_url( $custom_url ) . '">' . esc_html( $custom_title ) . '</a>';
		} else {
			$buffy .= '<span>' . esc_html( $custom_title ) . '</span>';
		}
		$buffy .= '</h4>';

		return $buffy;
	}

	/**
	 * @param $additional_classes_array array - of classes to add to the block
	 *
	 * @return string
	 */
	protected function get_block_classes( $additional_classes_array = array() ) {

		//add the block wrap class
		$block_classes = array(
			'tagdiv-block-wrap'
		);

		//marge the additional classes received from blocks code
		if ( ! empty( $additional_classes_array ) ) {
			$block_classes = array_merge(
				$block_classes,
				$additional_classes_array
			);
		}

		//remove duplicates
		$block_classes = array_unique( $block_classes );

		return implode( ' ', $block_classes );
	}
}

