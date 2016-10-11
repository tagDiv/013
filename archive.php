<?php
/**
 * The template for displaying archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

get_header(); ?>

	<div class="td-main-content-wrap td-container-wrap">
		<div class="td-container">
			<div class="td-pb-row">
				<div class="td-pb-span8 td-main-content" role="main">

					<?php if ( have_posts() ) { ?>

						<header class="tagdiv-page-header">
							<?php
							the_archive_title( '<h1 class="entry-title tagdiv-page-title">', '</h1>' );
							the_archive_description( '<div class="tagdiv-category-description">', '</div>' );
							?>
						</header><!-- .page-header -->

						<?php

						$tagdiv_current_column = 1;
						$row_is_open = false;

						// Start the Loop.
						while ( have_posts() ) : the_post();

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
								'prev_text'          => __( 'Previous page', 'tdmag' ),
								'next_text'          => __( 'Next page', 'tdmag' ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tdmag' ) . ' </span>',
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

				<div class="td-pb-span4 tagdiv-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div> <!-- /.td-pb-row -->
		</div> <!-- /.td-container -->
	</div> <!-- /.td-main-content-wrap -->

<?php get_footer(); ?>

