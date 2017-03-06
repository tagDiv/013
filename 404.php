<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage MeisterMag
 * @since MeisterMag 1.0
*/

get_header(); ?>

	<div class="tagdiv-main-content-wrap">
		<div class="tagdiv-container">
			<div class="tagdiv-span12">
				<div class="td-404-head">
					<div class="td-404-title"><?php _e( '404', 'meistermag' ); ?></div>
					<div class="td-404-sub-title"><?php _e( 'Oops!', 'meistermag' ); ?></div>
					<div class="td-404-sub-sub-title"><?php _e( 'Sorry, but the page you are looking for doesn&rsquo;t exist. Please use search for help', 'meistermag' ); ?></div>

					<div class="search-page-wrap">
						<?php get_search_form(); ?>
					</div>
				</div>

				<?php

				$args = array(
					'post_type'=> 'post',
					'showposts' => 3
				);

				query_posts($args);

				if ( have_posts() ) {

					$tagdiv_current_column = 1;
					$row_is_open = false;

					while ( have_posts() ) : the_post(); //Start the Loop

						if ( false === $row_is_open ) {
							$row_is_open = true;
							echo '<div class="tagdiv-row">'; // open a grid row
						} ?>

						<div class="tagdiv-span4">
							<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
						</div>

						<?php if ( 3 == $tagdiv_current_column and true === $row_is_open ) {
							$row_is_open = false;
							echo '</div>'; // close the grid row
						}

						if ( 3 == $tagdiv_current_column ) {
							$tagdiv_current_column = 1;
						} else {
							$tagdiv_current_column++;
						}

					endwhile; //End of the Loop

						if ( true === $row_is_open ) {
							$row_is_open = false;
							echo '</div>'; // close the grid row
						}

				} else {

					get_template_part( 'template-parts/content', 'none' );

				}

				wp_reset_query();
				?>
			</div>
		</div> <!-- /.tagdiv-container -->
	</div> <!-- /.tagdiv-main-content-wrap -->

<?php get_footer(); ?>
