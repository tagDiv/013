<?php
/**
 * The template for displaying archive pages.
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

				<?php

				//prepare the archives page title
				if ( is_day() ) {
					$td_archive_title = __td( 'Daily Archives:', 'tdmag' ). ' ' . get_the_date();
				} elseif ( is_month() ) {
					$td_archive_title = __td( 'Monthly Archives:', 'tdmag' ) . ' ' . get_the_date( 'F Y' );
				} elseif ( is_year() ) {
					$td_archive_title = __td( 'Yearly Archives:', 'tdmag' ) . ' ' . get_the_date( 'Y' );
				} else {
					$td_archive_title = __td( 'Archives', 'tdmag' );
				}

				?>

			<div class="td-pb-row">
				<div class="td-pb-span8 td-main-content">

					<div class="td-page-header">
						<h1 class="entry-title td-page-title">
							<span><?php echo $td_archive_title; ?></span>
						</h1>
					</div>

					<?php
					if ( have_posts() ) {
						global $wp_query;

						//Set up a post counter
						$counter = 0;

						//Start the Loop
						while ( have_posts() ) : the_post();

							//We are in loop so we can check if counter is odd or even
							if ( $counter % 2 == 0 ) { //odd
								echo '<div class="td-pb-row">'; // open row
							} ?>

							<div class="td-pb-span6">
								<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
							</div>

							<?php if ( $counter % 2 !== 0 and $counter !== 0 ) { //even
								echo '</div>'; // close row
							}

							$counter++;

							if ( $counter == $wp_query->post_count ) {
								echo '</div>'; // close row
								//die ("the end");
							}
						endwhile; //End of the Loop

						the_posts_navigation(/*array(
							'prev_text'          => '',
							'next_text'          => '',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
						)*/);
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
