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

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( TAGDIV_THEME_NAME . '-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( TAGDIV_THEME_NAME . '-html5', get_template_directory_uri() . '/includes/js_files/html5.js', array(), '3.7.3' );
	wp_script_add_data( TAGDIV_THEME_NAME . '-html5', 'conditional', 'lt IE 9' );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( TAGDIV_THEME_NAME . '-script', get_template_directory_uri() . '/includes/js_files/functions.js', array( 'jquery' ), '20160816', true );
	wp_enqueue_script( TAGDIV_THEME_NAME . 'menu-script', get_template_directory_uri() . '/includes/js_files/tdMenu.js', array( 'jquery' ), '20160819', true );
	wp_enqueue_script( TAGDIV_THEME_NAME . 'search-script', get_template_directory_uri() . '/includes/js_files/tdSearch.js', array( 'jquery' ), '20160819', true );

	wp_localize_script( TAGDIV_THEME_NAME . '-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', TAGDIV_THEME_NAME ),
		'collapse' => __( 'collapse child menu', TAGDIV_THEME_NAME ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );


if ( ! function_exists( 'tagdiv_post_thumbnail' ) ) :
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
		//print_r($post);

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail ">
				<?php the_post_thumbnail( 'td_640x0', array( 'alt' => get_the_title(), 'class' => 'entry-thumb, ' ) ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<div class="td-module-image">

				<?php if ( current_user_can( 'edit_posts' ) ) { ?>
					<a class="td-admin-edit" href="<?php echo get_edit_post_link( $post->ID ); ?>">edit</a>
				<?php } ?>

				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="">

				<div class="td-module-thumb">

				<?php the_post_thumbnail( 'td_300x220', array( 'alt' => get_the_title(), 'class' => 'entry-thumb' ) ); ?>

					<div class="td-post-category-wrap">
					<?php echo tagdiv_post_category(); ?>
					</div>

				</div> <!-- .td-module-thumb-->

				</a>

			</div> <!-- .td-module-image-->

		<?php endif; // End is_singular()
	}
endif;


if ( ! function_exists( 'tagdiv_post_category' ) ) :

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
		$categories_array  = array();

		$post_categories = '';

		if ( is_singular() ) :

			$categories = get_the_category( $post->ID );

			if (!empty($categories)) {
				foreach ( $categories as $category ) {
					if ( $category->name != TAGDIV_FEATURED_CAT ) { //ignore the featured category name

						$categories_array[ $category->name ]  = array(
							'link'         => get_category_link( $category->cat_ID )
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

			else :

				$selected_category_obj = '';
				$selected_category_obj_id = '';
				$selected_category_obj_name = '';

				// default post type
				$categories = get_the_category( $post->ID );

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


				if ( ! empty( $selected_category_obj ) ) {

//					echo '<pre>';
//					print_r($selected_category_obj->cat_ID);
//					print_r($selected_category_obj->name);
//					echo '</pre>';

					$selected_category_obj_id   = $selected_category_obj->cat_ID;
					$selected_category_obj_name = $selected_category_obj->name;
				}

				if ( ! empty( $selected_category_obj_id ) && ! empty( $selected_category_obj_name ) ) { //@todo catch error here
					$post_categories .= '<a href="' . get_category_link( $selected_category_obj_id ) . '" class="td-post-category">' . $selected_category_obj_name . '</a>';
				}

				return $post_categories;

		endif; // End is_singular()

	}

endif;


if ( ! function_exists( 'tagdiv_post_header' ) ) :

	/**
	 * Display the post header.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */

	function tagdiv_post_header() {

		global $post;

		if ( is_singular() ) : ?>

			<div class="td-post-header">

				<?php echo tagdiv_post_category(); ?>

				<header class="td-post-title">

					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>


					<!--post subtitles-->
					<?php /*if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { */?><!--
						<p class="td-post-sub-title"><?php /*echo $td_mod_single->td_post_theme_settings['td_subtitle'];*/?></p>
					--><?php /*} */?>

					<div class="td-module-meta-info">

						<span class="td-post-author-name"><div class="td-author-by">By</div>
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a>
						<span>-</span>
						</span>

						<span class="td-post-date">
						<time class="entry-date updated td-module-date" datetime="<?php echo date( DATE_W3C, get_the_time( 'U', get_the_ID() ) ); ?>" ><?php echo get_the_time( get_option( 'date_format' ), get_the_ID() ); ?></time>
						</span>

						<div class="td-module-comments">
							<a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo get_comments_number( get_the_ID() ); ?></a>
						</div>

						<!--post views-->
						<!--<div class="td-post-views-wrap">
							<?php /*echo $td_mod_single->get_views();*/?>
							<span class="td-post-views-text">views</span>
						</div>-->

					</div> <!-- .td-module-meta-info-->
				</header> <!-- .td-post-title -->
			</div> <!-- .td-post-header -->

		<?php else : ?>

			<header class="entry-header">
				<?php the_title( sprintf( '<h3 class="entry-title td-module-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );	?>


				<div class="td-module-meta-info">

					<span class="td-post-author-name">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a>
					<span>-</span>
					</span>

					<span class="td-post-date">
					<time class="entry-date updated td-module-date" datetime="<?php echo date( DATE_W3C, get_the_time( 'U', get_the_ID() ) ); ?>" ><?php echo get_the_time( get_option( 'date_format' ), get_the_ID() ); ?></time>
					</span>

					<div class="td-module-comments">
						<a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo get_comments_number( get_the_ID() ); ?></a>
					</div>

				</div>
			</header><!-- .entry-header -->

		<?php endif; // End is_singular()
	}

endif;

if ( ! function_exists( 'tagdiv_post_tags' ) ) :

	/**
	 * Display the post tags.
	 *
	 * @since TAGDIV_THEME_NAME 1.0
	 */

	function tagdiv_post_tags() {

		$tags_array  = array();

		$post_tags = '';

		if ( is_singular() ) :

			$tags = get_the_tags();
			if (!empty($tags)) {
				foreach ($tags as $tag) {
					$tags_array[$tag->name] = array (
						'url' => get_tag_link($tag->term_id)
					);
				}
			}

			if (!empty($tags_array)) {
				$post_tags .= '<ul class="td-tags td-post-small-box clearfix">';
				$post_tags .= '<li><span>TAGS</span></li>';
				foreach ($tags_array as $tag_name => $tag_params) {
					$post_tags .=  '<li><a href="' . $tag_params['url'] . '">' . $tag_name . '</a></li>';
				}
				$post_tags .= '</ul>';
			}

			return $post_tags;

			endif; // End is_singular()
		return '';
	}

endif;

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );