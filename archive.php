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
			<div class="td-pb-row">
				<div class="td-pb-span8 td-main-content">

					<?php
					the_archive_title( '<h1 class="entry-title td-page-title">', '</h1>' );

					if ( have_posts() ) {

						$tagdiv_column_number = 2;
						$tagdiv_current_column = 1;
						$row_is_open = false;

						while ( have_posts() ) : the_post();

							if ( $row_is_open === false ) {
								$row_is_open = true;
								echo '<div class="td-pb-row">'; // open row
							} ?>

							<div class="td-pb-span6">
								<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
							</div>

							<?php if ( $tagdiv_column_number == $tagdiv_current_column and $row_is_open === true ) {
								$row_is_open = false;
								echo '</div>'; // close row
							}

							if ( $tagdiv_column_number == $tagdiv_current_column ) {
								$tagdiv_current_column = 1;
							} else {
								$tagdiv_current_column++;
							}

						endwhile;

						if ( $row_is_open === true ) {
							$row_is_open = false;
							echo '</div>'; // close row
						} ?>

						<div class="page-nav page-nav-post">

							<?php
							the_posts_pagination( array(
								'prev_text'          => 'Previous page',
								'next_text'          => 'Next page',
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . __td( 'Page', 'tdmag' ) . ' </span>',
							) );
							?>

						</div>

					<?php
					} else {
						get_template_part( 'template-parts/content', 'none' );
					}
					?>

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
