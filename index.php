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

						$tagdiv_column_number = 2;
						$tagdiv_current_column = 1;
						$row_is_open = false;

						//Start the Loop
						while (have_posts()) : the_post();

							if ( $row_is_open === false ) {
								$row_is_open = true;
								echo '<div class="td-pb-row">'; // open a grid row
							} ?>

							<div class="td-pb-span6">
								<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
							</div>

							<?php if ( $tagdiv_column_number == $tagdiv_current_column and $row_is_open === true ) {
								$row_is_open = false;
								echo '</div>'; // close the grid row
							}

							if ( $tagdiv_column_number == $tagdiv_current_column ) {
								$tagdiv_current_column = 1;
							} else {
								$tagdiv_current_column++;
							}

						endwhile; //End of the Loop

						if ( $row_is_open === true ) {
							$row_is_open = false;
							echo '</div>'; // close the grid row
						}

						the_posts_navigation( array(
							'prev_text'          => '',
							'next_text'          => '',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __td( 'Page', 'tdmag' ) . ' </span>',
						) );
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
