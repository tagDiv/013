<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tdmag
 */

get_header(); ?>

	<div class="td-main-content-wrap td-container-wrap">
		<div class="td-container">

			<div class="td-crumb-container">
				<?php //echo td_page_generator::get_home_breadcrumbs(); ?>
			</div>

			<div class="td-pb-row">
				<div class="td-pb-span8 td-main-content">

					<?php if ( have_posts() ) {

						while (have_posts()) : the_post();
							get_template_part('template-parts/content', 'page' );
						endwhile;

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					} else {
						get_template_part( 'template-parts/content', 'none' );
					} ?>

				</div>

				<div class="td-pb-span4 td-main-sidebar">

					<?php get_sidebar(); ?>

				</div>

			</div> <!-- /.td-pb-row -->

		</div> <!-- /.td-container -->
	</div> <!-- /.td-main-content-wrap -->


<?php
get_sidebar();
get_footer();
