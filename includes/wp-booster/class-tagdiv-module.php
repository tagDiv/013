<?php

abstract class Tagdiv_Module {
	var $post;

	var $title_attribute;
	var $title;             // by default the WordPress title is not escaped on twenty fifteen
	var $href;


	/**
	 * @var mixed the review metadata - we get it for each $post
	 */
	protected $tagdiv_review;

	/**
	 * @var bool is true if we have a review for this $post
	 */
	protected $is_review = false;

	/**
	 * @var int|null Contains the id of the current $post thumbnail. If no thumbnail is found, the value is NULL
	 */
	protected $post_thumb_id = null;


	/**
	 * @param $post WP_Post
	 *
	 * @throws ErrorException
	 */
	function __construct( $post ) {
		if ( gettype( $post ) != 'object' || get_class( $post ) != 'WP_Post' ) {
			Tagdiv_Util::error( __FILE__, 'td_module: ' . get_Class( $this ) . '($post): $post is not WP_Post' );
		}


		//this filter is used by tagdiv_unique_posts.php - to add unique posts to the array for the datasource
		apply_filters( "td_wp_booster_module_constructor", $this, $post );

		$this->post = $post;

		// by default the WordPress title is not escaped on twenty fifteen
		$this->title           = get_the_title( $post->ID );
		$this->title_attribute = esc_attr( strip_tags( $this->title ) );
		$this->href            = esc_url( get_permalink( $post->ID ) );

		if ( has_post_thumbnail( $this->post->ID ) ) {
			$tmp_get_post_thumbnail_id = get_post_thumbnail_id( $this->post->ID );
			if ( ! empty( $tmp_get_post_thumbnail_id ) ) {
				// if we have a wrong id, leave the post_thumb_id NULL
				$this->post_thumb_id = $tmp_get_post_thumbnail_id;
			}
		}

		//get the review metadata
		//$this->tagdiv_review = get_post_meta($this->post->ID, 'tagdiv_review', true); @todo $this->tagdiv_review variable name must be replaced and the 'get_quotes_on_blocks', 'get_category' methods also
		$this->tagdiv_review = get_post_meta( $this->post->ID, 'td_post_theme_settings', true );

		if ( ! empty( $this->tagdiv_review['has_review'] ) && (
				! empty( $this->tagdiv_review['p_review_stars'] ) ||
				! empty( $this->tagdiv_review['p_review_percents'] ) ||
				! empty( $this->tagdiv_review['p_review_points'] )
			)
		) {
			$this->is_review = true;
		}
	}


	/**
	 * @deprecated - google changed the structured data requirements and we no longer use them on modules
	 */
	function get_item_scope() {
		return '';
	}


	/**
	 * @deprecated - google changed the structured data requirements and we no longer use them on modules
	 */
	function get_item_scope_meta() {
		return '';
	}


	function get_module_classes( $additional_classes_array = '' ) {
		//add the wrap and module id class
		$buffy = get_class( $this );


		// each module setting has a 'class' key to customize css
		$module_class = Tagdiv_API_Module::get_key( get_class( $this ), 'class' );

		if ( $module_class != '' ) {
			$buffy .= ' ' . $module_class;
		}


		//show no thumb only if no thumb is detected and image placeholders are disabled
		if ( is_null( $this->post_thumb_id ) && Tagdiv_Util::get_option( 'tds_hide_featured_image_placeholder' ) == 'hide_placeholder' ) {
			$buffy .= ' td_module_no_thumb';
		}

		// fix the meta info space when all options are off
		if ( Tagdiv_Util::get_option( 'tds_m_show_author_name' ) == 'hide' && Tagdiv_Util::get_option( 'tds_m_show_date' ) == 'hide' && Tagdiv_Util::get_option( 'tds_m_show_comments' ) == 'hide' ) {
			$buffy .= ' td-meta-info-hide';
		}

		if ( $additional_classes_array != '' && is_array( $additional_classes_array ) ) {
			$buffy .= ' ' . implode( ' ', $additional_classes_array );
		}

		// the following case could not be checked
		// $buffy = implode(' ', array_unique(explode(' ', $buffy)));

		return $buffy;
	}


	function get_author() {
		$buffy = '';

		if ( $this->is_review === false ) {
			if ( Tagdiv_Util::get_option( 'tds_m_show_author_name' ) != 'hide' ) {
				$buffy .= '<span class="td-post-author-name">';
				$buffy .= '<a href="' . get_author_posts_url( $this->post->post_author ) . '">' . get_the_author_meta( 'display_name', $this->post->post_author ) . '</a>';
				if ( Tagdiv_Util::get_option( 'tds_m_show_author_name' ) != 'hide' && Tagdiv_Util::get_option( 'tds_m_show_date' ) != 'hide' ) {
					$buffy .= ' <span>-</span> ';
				}
				$buffy .= '</span>';
			}

		}

		return $buffy;

	}


	function get_date( $show_stars_on_review = true ) {
		$visibility_class = '';
		if ( Tagdiv_Util::get_option( 'tds_m_show_date' ) == 'hide' ) {
			$visibility_class = ' td-visibility-hidden';
		}

		$buffy = '';
		if ( $this->is_review && $show_stars_on_review === true ) {
			//if review show stars
			$buffy .= '<div class="entry-review-stars">';
			$buffy .= tagdiv_review::render_stars( $this->tagdiv_review );
			$buffy .= '</div>';

		} else {
			if ( Tagdiv_Util::get_option( 'tds_m_show_date' ) != 'hide' ) {
				$tagdiv_article_date_unix = get_the_time( 'U', $this->post->ID );
				$buffy .= '<span class="td-post-date">';
				$buffy .= '<time class="entry-date updated td-module-date' . $visibility_class . '" datetime="' . date( DATE_W3C, $tagdiv_article_date_unix ) . '" >' . get_the_time( get_option( 'date_format' ), $this->post->ID ) . '</time>';
				$buffy .= '</span>';
			}
		}

		return $buffy;
	}

	function get_comments() {
		$buffy = '';
		if ( Tagdiv_Util::get_option( 'tds_m_show_comments' ) != 'hide' ) {
			$buffy .= '<div class="td-module-comments">';
			$buffy .= '<a href="' . get_comments_link( $this->post->ID ) . '">';
			$buffy .= get_comments_number( $this->post->ID );
			$buffy .= '</a>';
			$buffy .= '</div>';
		}

		return $buffy;
	}


	/**
	 * get image - v 3.0  23 ian 2015
	 *
	 * @param $thumbType
	 *
	 * @return string
	 */
	function get_image( $thumbType ) {
		$buffy                               = ''; //the output buffer
		$tds_hide_featured_image_placeholder = Tagdiv_Util::get_option( 'tds_hide_featured_image_placeholder' );
		//retina image
		$srcset_sizes = '';

		// do we have a post thumb or a placeholder?
		if ( ! is_null( $this->post_thumb_id ) || ( $tds_hide_featured_image_placeholder != 'hide_placeholder' ) ) {

			if ( ! is_null( $this->post_thumb_id ) ) {

				// the thumb is enabled from the panel, it's time to show the real thumb
				$tagdiv_temp_image_url = wp_get_attachment_image_src( $this->post_thumb_id, $thumbType );
				$attachment_alt        = get_post_meta( $this->post_thumb_id, '_wp_attachment_image_alt', true );
				$attachment_alt        = 'alt="' . esc_attr( strip_tags( $attachment_alt ) ) . '"';
				$attachment_title      = ' title="' . esc_attr( strip_tags( $this->title ) ) . '"';

				if ( empty( $tagdiv_temp_image_url[0] ) ) {
					$tagdiv_temp_image_url[0] = '';
				}

				if ( empty( $tagdiv_temp_image_url[1] ) ) {
					$tagdiv_temp_image_url[1] = '';
				}

				if ( empty( $tagdiv_temp_image_url[2] ) ) {
					$tagdiv_temp_image_url[2] = '';
				}

				//retina image
				$srcset_sizes = Tagdiv_Util::get_srcset_sizes( $this->post_thumb_id, $thumbType, $tagdiv_temp_image_url[1], $tagdiv_temp_image_url[0] );

			} else {
				//we have no thumb but the placeholder one is activated
				global $_wp_additional_image_sizes;

				if ( empty( $_wp_additional_image_sizes[ $thumbType ]['width'] ) ) {
					$tagdiv_temp_image_url[1] = '';
				} else {
					$tagdiv_temp_image_url[1] = $_wp_additional_image_sizes[ $thumbType ]['width'];
				}

				if ( empty( $_wp_additional_image_sizes[ $thumbType ]['height'] ) ) {
					$tagdiv_temp_image_url[2] = '';
				} else {
					$tagdiv_temp_image_url[2] = $_wp_additional_image_sizes[ $thumbType ]['height'];
				}

				/**
				 * get thumb height and width via api
				 * first we check the global in case a custom thumb is used
				 *
				 * The api thumb is checked only for additional sizes registered and if at least one of the settings (width or height) is empty.
				 * This should be enough to avoid getting a non existing id using api thumb.
				 */
				if ( ! empty( $_wp_additional_image_sizes ) && array_key_exists( $thumbType, $_wp_additional_image_sizes ) && ( $tagdiv_temp_image_url[1] == '' || $tagdiv_temp_image_url[2] == '' ) ) {
					$tagdiv_thumb_parameters  = Tagdiv_API_Thumb::get_by_id( $thumbType );
					$tagdiv_temp_image_url[1] = $tagdiv_thumb_parameters['width'];
					$tagdiv_temp_image_url[2] = $tagdiv_thumb_parameters['height'];
				}


				$tagdiv_temp_image_url[0] = Tagdiv_Global::$get_template_directory_uri . '/images/no-thumb/' . $thumbType . '.png';
				$attachment_alt           = 'alt=""';
				$attachment_title         = '';
			} //end    if ($this->post_has_thumb) {


			$buffy .= '<div class="td-module-thumb">';
			if ( current_user_can( 'edit_posts' ) ) {
				$buffy .= '<a class="td-admin-edit" href="' . get_edit_post_link( $this->post->ID ) . '">edit</a>';
			}

			$buffy .= '<a href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
			$buffy .= '<img width="' . $tagdiv_temp_image_url[1] . '" height="' . $tagdiv_temp_image_url[2] . '" class="entry-thumb" src="' . $tagdiv_temp_image_url[0] . '"' . $srcset_sizes . ' ' . $attachment_alt . $attachment_title . '/>';

			// on videos add the play icon
			if ( get_post_format( $this->post->ID ) == 'video' ) {

				$use_small_post_format_icon_size = false;
				// search in all the thumbs for the one that we are currently using here and see if it has post_format_icon_size = small
				foreach ( Tagdiv_API_Thumb::get_all() as $thumb_from_thumb_list ) {
					if ( $thumb_from_thumb_list['name'] == $thumbType && $thumb_from_thumb_list['post_format_icon_size'] == 'small' ) {
						$use_small_post_format_icon_size = true;
						break;
					}
				}

				// load the small or medium play icon
				if ( $use_small_post_format_icon_size === true ) {
					$buffy .= '<span class="td-video-play-ico td-video-small"><img width="20" height="20" class="td-retina" src="' . Tagdiv_Global::$get_template_directory_uri . '/images/icons/video-small.png' . '" alt="video"/></span>';
				} else {
					$buffy .= '<span class="td-video-play-ico"><img width="40" height="40" class="td-retina" src="' . Tagdiv_Global::$get_template_directory_uri . '/images/icons/ico-video-large.png' . '" alt="video"/></span>';
				}
			} // end on video if

			$buffy .= '</a>';
			$buffy .= '</div>'; //end wrapper

			return $buffy;
		}
	}


	/**
	 * This function returns the title with the appropriate markup.
	 *
	 * @param string $cut_at - if provided, the method will just cut at that point
	 *                       and it will cut after that. If not setting is in the database the function will cut at the default value
	 *
	 * @return string
	 */

	function get_title( $cut_at = '' ) {
		$buffy = '';
		$buffy .= '<h3 class="entry-title td-module-title">';
		$buffy .= '<a href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';

		//see if we have to cut the title and if we have the title lenght in the panel for ex: tagdiv_module_6__title_excerpt
		if ( $cut_at != '' ) {
			//cut at the hard coded size
			$buffy .= Tagdiv_Util::excerpt( $this->title, $cut_at, 'show_shortcodes' );

		} else {
			/**
			 * no $cut_at provided -> return the full title
			 * @see Tagdiv_Global::$modules_list
			 */
			$buffy .= $this->title;

		}
		$buffy .= '</a>';
		$buffy .= '</h3>';

		return $buffy;
	}


	/**
	 * This method is used by modules to get content that has to be excerpted (cut)
	 * IT RETURNS THE EXCERPT FROM THE POST IF IT'S ENTERED IN THE EXCERPT CUSTOM POST FIELD BY THE USER
	 *
	 * @param string $cut_at - if provided the method will just cat at that point
	 *
	 * @return string
	 */
	function get_excerpt( $cut_at = '' ) {

		//If the user supplied the excerpt in the post excerpt custom field, we just return that
		if ( $this->post->post_excerpt != '' ) {
			return $this->post->post_excerpt;
		}

		$buffy = '';
		if ( $cut_at != '' ) {
			// simple, $cut_at and return
			$buffy .= Tagdiv_Util::excerpt( $this->post->post_content, $cut_at );
		}  else {
				/**
				 * no $cut_at provided -> return the full $this->post->post_content
			* @see Tagdiv_Global::$modules_list
			*/
				$buffy .= $this->post->post_content;
		}

		return $buffy;
	}


	function get_category() {

		$buffy                      = '';
		$selected_category_obj      = '';
		$selected_category_obj_id   = '';
		$selected_category_obj_name = '';

			//read the post meta to get the custom primary category
			$tagdiv_post_theme_settings = get_post_meta( $this->post->ID, 'td_post_theme_settings', true );
			if ( ! empty( $tagdiv_post_theme_settings['td_primary_cat'] ) ) {
				//we have a custom category selected
				$selected_category_obj = get_category( $tagdiv_post_theme_settings['td_primary_cat'] );
			} else {

				//get one auto
				$categories = get_the_category( $this->post->ID );

				if ( is_category() ) {
					foreach ( $categories as $category ) {
						if ( $category->term_id == get_query_var( 'cat' ) ) {
							$selected_category_obj = $category;
							break;
						}
					}
				}

				if ( empty( $selected_category_obj ) && ! empty( $categories[0] ) ) {
					if ( $categories[0]->name === TAGDIV_FEATURED_CAT && ! empty( $categories[1] ) ) {
						$selected_category_obj = $categories[1];
					} else {
						$selected_category_obj = $categories[0];
					}
				}
			}

			if ( ! empty( $selected_category_obj ) ) {
				$selected_category_obj_id   = $selected_category_obj->cat_ID;
				$selected_category_obj_name = $selected_category_obj->name;
			}



		if ( ! empty( $selected_category_obj_id ) && ! empty( $selected_category_obj_name ) ) { //@todo catch error here
			$buffy .= '<a href="' . get_category_link( $selected_category_obj_id ) . '" class="td-post-category">' . $selected_category_obj_name . '</a>';
		}

		//return print_r($post, true);
		return $buffy;
	}

}