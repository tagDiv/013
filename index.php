<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

					<?php
					if ( have_posts() ) {

						if ( is_home() && ! is_front_page() ) { ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php }

						global $wp_query;

						//Set up a post counter
						$counter = 0;

						//Start the Loop
						while (have_posts()) : the_post();

							//We are in loop so we can check if counter is odd or even
							if ( $counter % 2 == 0 ) { //odd
								echo '<div class="td-pb-row">'; // open row
							} ?>

							<div class="td-pb-span6">
								<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
							</div>

							<?php if ( ( $counter % 2 !== 0 and $counter !== 0 ) ) { //even
								echo '</div>'; // close row
							}

							$counter++;

							if ( $counter == $wp_query->post_count ) {
								echo '</div>'; // close row
								//die ("the end");
							}
						endwhile; //End of the Loop

						the_posts_navigation( /*array(
							'prev_text'          => '',
							'next_text'          => '',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
						)*/ );
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

get_footer();
