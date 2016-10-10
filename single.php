<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

get_header(); ?>

	<div class="td-main-content-wrap td-container-wrap">
		<div class="td-container">
			<div class="td-pb-row">
				<div class="td-pb-span8 td-main-content">

					<?php
						// Start the Loop
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', get_post_format() );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}

						endwhile; // //End of the Loop
				 	?>

				</div>

				<div class="td-pb-span4 tagdiv-sidebar">
					<?php get_sidebar(); ?>
				</div>

			</div> <!-- /.td-pb-row -->
		</div> <!-- /.td-container -->
	</div> <!-- /.td-main-content-wrap -->

<?php get_footer(); ?>
