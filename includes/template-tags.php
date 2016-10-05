<?php
/**
 * Custom TAGDIV_THEME_NAME template tags
 *
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

if ( ! function_exists( 'tagdiv_post_thumbnail' ) ) {
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */
	function tagdiv_post_thumbnail() {
		global $post;

		if ( post_password_required() || is_attachment() || !has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {
			?>

			<div class="post-thumbnail ">
				<?php
				the_post_thumbnail( 'td_640x0', array( 'alt' => get_the_title(), 'class' => 'entry-thumb, ' ) );
				?>
			</div><!-- .post-thumbnail -->

		<?php } else { ?>

			<div class="td-module-image">

				<!--<a href="<?php /*echo esc_url( get_permalink() ); */?>" rel="bookmark" title=""> -->

				<div class="td-module-thumb">

					<?php if ( current_user_can('edit_posts') ) { ?>
						<a class="td-admin-edit" href="<?php echo get_edit_post_link( $post->ID ); ?>">edit</a>
					<?php } ?>

					<?php the_post_thumbnail( 'td_300x220', array('alt' => get_the_title(), 'class' => 'entry-thumb') ); ?>

					<div class="td-post-category-wrap">
						<?php echo tagdiv_post_category(); ?>
					</div>

				</div><!-- .td-module-thumb-->

				<!--</a>-->

			</div> <!-- .td-module-image-->

		<?php }// End is_singular()
	}
}

if ( ! function_exists( 'tagdiv_post_category' ) ) {
	/**
	 * Display the post categories.
	 *
	 * If multiple this returns the first category on tagdiv module
	 *
	 * and a list of posts categories when on single views.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */
	function tagdiv_post_category() {

		global $post;
		$categories_array = array();

		$post_categories = '';

		if ( is_singular() ) {

			$categories = get_the_category( $post->ID );

			if ( ! empty( $categories ) ) {
				foreach ( $categories as $category ) {
					if ($category->name != TAGDIV_FEATURED_CAT) { //ignore the featured category name

						$categories_array[$category->name] = array(
							'link' => get_category_link( $category->cat_ID )
						);
					}
				}
			}

			$post_categories .= '<ul class="td-category">';


			foreach ( $categories_array as $category_name => $category_params ) {
				$post_categories .= '<li class="entry-category"><a href="' . $category_params['link'] . '">' . $category_name . '</a></li>';
			}
			$post_categories .= '</ul>';

			return $post_categories;

		} else {

			$selected_category_obj      = '';
			$selected_category_obj_id   = '';
			$selected_category_obj_name = '';

			// default post type
			$categories = get_the_category( $post->ID );

			if ( is_category() ) {
				foreach ( $categories as $category ) {
					if ($category->term_id == get_query_var('cat')) {
						$selected_category_obj = $category;
						break;
					}
				}
			}

			if ( empty( $selected_category_obj ) && ! empty( $categories[0] )) {
				if ( $categories[0]->name === TAGDIV_FEATURED_CAT && ! empty( $categories[1] ) ) {
					$selected_category_obj = $categories[1];
				} else {
					$selected_category_obj = $categories[0];
				}
			}


			if ( ! empty( $selected_category_obj ) ) {
				$selected_category_obj_id = $selected_category_obj->cat_ID;
				$selected_category_obj_name = $selected_category_obj->name;
			}

			if ( ! empty( $selected_category_obj_id ) && ! empty( $selected_category_obj_name ) ) { //@todo catch error here
				$post_categories .= '<a href="' . get_category_link( $selected_category_obj_id ) . '" class="td-post-category">' . $selected_category_obj_name . '</a>';
			}

			return $post_categories;

		} // End is_singular()

	}
}

if ( ! function_exists( 'tagdiv_post_header' ) ) {
	/**
	 * Display the post header.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */
	function tagdiv_post_header() {

		if ( is_singular() ) { ?>

			<div class="td-post-header">

				<?php echo tagdiv_post_category(); ?>

				<header>

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="td-module-meta-info">

					<span class="td-post-author-name">
						<span class="td-author-by">By</span>
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a>
					<span>-</span>
					</span>

					<span class="td-post-date">
					<time class="entry-date updated"
						  datetime="<?php echo date( DATE_W3C, get_the_time( 'U', get_the_ID() ) ); ?>"><?php echo get_the_time( get_option( 'date_format' ), get_the_ID() ); ?></time>
					</span>

						<div class="td-post-comments">
							<a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo get_comments_number( get_the_ID() ); ?></a>
						</div>

					</div><!-- .td-module-meta-info-->
				</header>
			</div> <!-- .td-post-header -->

		<?php } else { ?>

			<header class="entry-header">
				<?php the_title( sprintf( '<h3 class="entry-title td-module-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

				<div class="td-module-meta-info">

				<span class="td-post-author-name">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a>
				<span>-</span>
				</span>

				<span class="td-post-date">
				<time class="entry-date updated td-module-date"
					  datetime="<?php echo date(DATE_W3C, get_the_time('U', get_the_ID())); ?>"><?php echo get_the_time( get_option( 'date_format' ), get_the_ID() ); ?></time>
				</span>

					<div class="td-module-comments">
						<a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo get_comments_number( get_the_ID() ); ?></a>
					</div>

				</div>
			</header><!-- .entry-header -->

		<?php } // End is_singular()
	}
}

if ( ! function_exists( 'tagdiv_post_tags' ) ) {
	/**
	 * Display the post tags.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */
	function tagdiv_post_tags() {

		$tags_array = array();
		$post_tags = '';

		if ( is_singular() ) {

			$tags = get_the_tags();
			if ( ! empty( $tags ) ) {
				foreach ( $tags as $tag ) {
					$tags_array[ $tag->name ] = array(
						'url' => get_tag_link( $tag->term_id )
					);
				}
			}

			if ( ! empty( $tags_array )) {
				$post_tags .= '<ul class="td-tags td-post-small-box clearfix">';
				$post_tags .= '<li><span>TAGS</span></li>';
				foreach ( $tags_array as $tag_name => $tag_params ) {
					$post_tags .= '<li><a href="' . $tag_params['url'] . '">' . $tag_name . '</a></li>';
				}
				$post_tags .= '</ul>';
			}

			return $post_tags;

		} // End is_singular()
		return '';
	}
}

if ( ! function_exists( 'tagdiv_next_prev_posts' ) ) {
	/**
	 * Display the next/prev posts.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */
	function tagdiv_next_prev_posts() {

		$next_prev_posts = '';

		$next_post = get_next_post();
		$prev_post = get_previous_post();

		if ( is_singular() ) {

			if ( ! empty( $next_post ) or ! empty( $prev_post ) ) {

				$next_prev_posts .= '<div class="td-pb-row td-post-next-prev">';
				if ( ! empty( $prev_post ) ) {
					$next_prev_posts .= '<div class="td-pb-span6 td-post-prev-post">';
					$next_prev_posts .= '<div class="td-post-next-prev-content"><span>' .__td( 'Previous article', 'tdmag' ) . '</span>';
					$next_prev_posts .= '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '">' . get_the_title( $prev_post->ID ) . '</a>';
					$next_prev_posts .= '</div>';
					$next_prev_posts .= '</div>';
				} else {
					$next_prev_posts .= '<div class="td-pb-span6 td-post-prev-post">';
					$next_prev_posts .= '</div>';
				}
				$next_prev_posts .= '<div class="td-next-prev-separator"></div>';
				if ( ! empty( $next_post ) ) {
					$next_prev_posts .= '<div class="td-pb-span6 td-post-next-post">';
					$next_prev_posts .= '<div class="td-post-next-prev-content"><span>' .__td('Next article', 'tdmag') . '</span>';
					$next_prev_posts .= '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '">' . get_the_title( $next_post->ID ) . '</a>';
					$next_prev_posts .= '</div>';
					$next_prev_posts .= '</div>';
				}
				$next_prev_posts .= '</div>';
			}

			return $next_prev_posts;

		} // End is_singular()
		return '';
	}
}

if ( ! function_exists( 'tagdiv_author_box' ) ) {
	/**
	 * Display the post author box.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */
	function tagdiv_author_box() {
		global $post;
		$author_box = '';

		if ( is_singular() ) {

			$author_box .= '<div class="author-box-wrap">';
			$author_box .= '<a href="' . get_author_posts_url($post->post_author) . '">';
			$author_box .= get_avatar(get_the_author_meta('email', $post->post_author), '96');
			$author_box .= '</a>';


			$author_box .= '<div class="desc">';
			$author_box .= '<div class="td-author-name vcard author"><span class="fn">';
			$author_box .= '<a href="' . get_author_posts_url($post->post_author) . '">' . get_the_author_meta('display_name', $post->post_author) . '</a>';
			$author_box .= '</span></div>';

			if (get_the_author_meta('user_url', $post->post_author) != '') {
				$author_box .= '<div class="td-author-url"><a href="' . get_the_author_meta('user_url', $post->post_author) . '">' . get_the_author_meta('user_url', $post->post_author) . '</a></div>';
			}

			$author_box .= '<div class="td-author-description">';
			$author_box .= get_the_author_meta('description', $post->post_author);
			$author_box .= '</div>';

			$author_box .= '<div class="clearfix"></div>';

			$author_box .= '</div>'; //desc
			$author_box .= '</div>'; //author-box-wrap

			return $author_box;

		} // End is_singular()
		return '';
	}
}

if ( ! function_exists( 'tagdiv_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */
	function tagdiv_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}