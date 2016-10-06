<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package tdmag
 */

get_header();
?>

	<div class="td-main-content-wrap td-container-wrap">

		<div class="td-search-header td-container-wrap">
			<div class="td-container">
				<div class="td-pb-span12">

					<h1 class="entry-title td-page-title">
						<span class="td-search-query"><?php echo get_search_query(); ?></span> - <span> <?php  echo __td('search results', 'tdmag');?></span>
					</h1>

					<div class="search-page-wrap">
					<?php get_search_form(); ?>
					</div>

				</div>
			</div>
		</div>

		<div class="td-container">
			<div class="td-pb-row">

				<div class="td-pb-span8 td-main-content" role="main">

						<?php
						$tagdiv_template_layout = new Tagdiv_Template_Layout('default');
						if ( have_posts() ) {

							while (have_posts()) : the_post();

								echo $tagdiv_template_layout -> layout_open_element();

								global $post;
								$tagdiv_modul_1 = new Tagdiv_Module_1($post);
								echo $tagdiv_modul_1->render();

								echo $tagdiv_template_layout -> layout_close_element();
								$tagdiv_template_layout -> layout_next();

							endwhile;

							echo $tagdiv_template_layout -> close_all_tags(); ?>

							<div class="page-nav page-nav-post">

								<?php
								the_posts_pagination( array(
									'prev_text'          => '',
									'next_text'          => '',
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
								) );
								?>

							</div>

							<?php

						} else {
							get_template_part( 'template-parts/content', 'none' );
						}
						?>

				</div>

				<div class="td-pb-span4 td-main-sidebar" role="complementary">
					<?php get_sidebar(); ?>
				</div>

				</div> <!-- /.td-pb-row -->

		</div> <!-- /.td-container -->
	</div> <!-- /.td-main-content-wrap -->

<?php
get_sidebar();
get_footer();
