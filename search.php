<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

get_header(); ?>

	<div class="td-main-content-wrap td-container-wrap">
		<div class="td-search-header">
			<div class="td-container">
				<div class="td-pb-span12">

					<h1 class="entry-title tagdiv-page-title">
						<span class="td-search-query"><?php echo get_search_query(); ?></span> - <span> <?php  echo __td( 'search results', 'tdmag' );?></span>
					</h1>

					<div class="search-page-wrap">
					<?php get_search_form(); ?>
					</div>

				</div>
			</div>
		</div> <!-- .td-search-header -->

		<div class="td-container">
			<div class="td-pb-row">
				<div class="td-pb-span8 td-main-content" role="main">

						<?php if ( have_posts() ) { ?>

							<?php

							$tagdiv_current_column = 1;
							$row_is_open = false;

							while (have_posts()) : the_post(); // Start the loop.

								if ( false === $row_is_open ) {
									$row_is_open = true;
									echo '<div class="td-pb-row">'; // open a grid row
								} ?>

								<div class="td-pb-span6">
									<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
								</div>

								<?php if ( 2 == $tagdiv_current_column and true === $row_is_open ) {
									$row_is_open = false;
									echo '</div>'; // close the grid row
								}

								if ( 2 == $tagdiv_current_column ) {
									$tagdiv_current_column = 1;
								} else {
									$tagdiv_current_column++;
								}

							endwhile; //End of the Loop

							if ( true === $row_is_open ) {
								$row_is_open = false;
								echo '</div>'; // close the grid row
							} ?>

							<div class="page-nav page-nav-post">

								<?php
								// Previous/next page navigation.
								the_posts_pagination( array(
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __td( 'Page', 'tdmag' ) . ' </span>',
								) );
								?>

							</div>

						<?php
						// If no content, include the "No posts found" template.
						} else {
							get_template_part( 'template-parts/content', 'none' );
						}
						?>

				</div>

				<div class="td-pb-span4 tagdiv-sidebar" role="complementary">
					<?php get_sidebar(); ?>
				</div>
			</div> <!-- /.td-pb-row -->
		</div> <!-- /.td-container -->
	</div> <!-- /.td-main-content-wrap -->

<?php get_footer(); ?>
