<?php

class Tagdiv_Data_Source {

	/**
	 * creates the $args array
	 *
	 * @param string $atts  : the query attributes
	 *
	 * @return array
	 */
	static function shortcode_to_args( $atts = '' ) {
		extract( shortcode_atts(
				array(
					'post_ids'                    => '',
					'category_ids'                => '',
					'category_id'                 => '',
					'tag_slug'                    => '',
					'sort'                        => '',
					'limit'                       => '',
					'autors_id'                   => '',
					'installed_post_types'        => '',
					'offset'                      => '',
				),
				$atts
			)
		);

		//init the array
		$wp_query_args = array(
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish'
		);

		//the query goes only via $category_ids - for both options ($category_ids and $category_id) also $category_ids overwrites $category_id
		if ( ! empty( $category_id ) && empty( $category_ids ) ) {
			$category_ids = $category_id;
		}

		if ( ! empty( $category_ids ) ) {
			$wp_query_args['cat'] = $category_ids;
		}

		// tag slug filter
		if ( ! empty( $tag_slug ) ) {
			$wp_query_args['tag'] = str_replace( ' ', '-', $tag_slug );
		}

		switch ( $sort ) {

			case 'oldest_posts':
				$wp_query_args['order'] = 'ASC';
				break;

			case 'random_posts':
				$wp_query_args['orderby'] = 'rand';
				break;

			case 'alphabetical_order':
				$wp_query_args['orderby'] = 'title';
				$wp_query_args['order']   = 'ASC';
				break;

			case 'comment_count':
				$wp_query_args['orderby'] = 'comment_count';
				$wp_query_args['order']   = 'DESC';
				break;

			case 'random_today':
				$wp_query_args['orderby']  = 'rand';
				$wp_query_args['year']     = date( 'Y' );
				$wp_query_args['monthnum'] = date( 'n' );
				$wp_query_args['day']      = date( 'j' );
				break;

			case 'random_7_day':
				$wp_query_args['orderby']    = 'rand';
				$wp_query_args['date_query'] = array(
					'column' => 'post_date_gmt',
					'after'  => '1 week ago'
				);
				break;
		}

		if ( ! empty( $autors_id ) ) {
			$wp_query_args['author'] = $autors_id;
		}

		// add post_type to query
		if ( ! empty( $installed_post_types ) ) {
			$array_selected_post_types = array();
			$expl_installed_post_types = explode( ',', $installed_post_types );

			foreach ( $expl_installed_post_types as $val_this_post_type ) {
				if ( trim( $val_this_post_type ) != '' ) {
					$array_selected_post_types[] = trim( $val_this_post_type );
				}
			}

			$wp_query_args['post_type'] = $array_selected_post_types; //$installed_post_types;
		}

		// post in section
		if ( ! empty( $post_ids ) ) {

			// split posts id string
			$post_id_array = explode( ',', $post_ids );

			$post_in     = array();
			$post_not_in = array();

			// split ids into post_in and post_not_in
			foreach ( $post_id_array as $post_id ) {
				$post_id = trim( $post_id );

				// check if the ID is actually a number
				if ( is_numeric( $post_id ) ) {
					if ( intval( $post_id ) < 0 ) {
						$post_not_in [] = str_replace( '-', '', $post_id );
					} else {
						$post_in [] = $post_id;
					}
				}
			}

			// don't pass an empty post__in because it will return had_posts()
			if ( ! empty( $post_in ) ) {
				$wp_query_args['post__in'] = $post_in;
				$wp_query_args['orderby']  = 'post__in';
			}

			// check if the post__not_in is already set, if it is merge it with $post_not_in
			if ( ! empty( $post_not_in ) ) {
				if ( ! empty( $wp_query_args['post__not_in'] ) ) {
					$wp_query_args['post__not_in'] = array_merge( $wp_query_args['post__not_in'], $post_not_in );
				} else {
					$wp_query_args['post__not_in'] = $post_not_in;
				}
			}
		}

		//custom pagination limit
		if ( empty( $limit ) ) {
			$limit = get_option( 'posts_per_page' );
		}

		$wp_query_args['posts_per_page'] = $limit;

		return $wp_query_args;
	}

	/**
	 * used by blocks
	 *
	 * @param string $atts
	 *
	 * @return WP_Query
	 */
	static function &get_wp_query( $atts = '' ) { //by ref
		$args = self::shortcode_to_args( $atts );

		$tagdiv_query = new WP_Query( $args );

		return $tagdiv_query;
	}

}

