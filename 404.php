<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package tdmag
*/

get_header(); ?>

	<div class="td-main-content-wrap td-container-wrap">
		<div class="td-container">
			<div class="td-pb-span12">
				<div class="td-404-head">
					<div class="td-404-title"><?php echo __td( '404', 'tdmag' ); ?></div>
					<div class="td-404-sub-title"><?php echo __td( 'Oops!', 'tdmag' ); ?></div>
					<div class="td-404-sub-sub-title"><?php echo __td( 'Sorry, but the page you are looking for doesn&rsquo;t exist. Please use search for help', 'tdmag' ); ?></div>

					<div class="search-page-wrap">
						<form method="get" class="td-search-form-widget" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<div role="search">
								<label>
									<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'tdmag' ); ?></span>
									<input class="td-widget-search-input" type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'tdmag' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" />
								<input class="wpb_button wpb_btn-inverse btn" type="submit" id="searchsubmit" value="Search<?php __td( 'Search', 'tdmag' )?>" />
							</div>
						</form>
					</div>
				</div>

				<?php

				$args = array(
					'post_type'=> 'post',
					'showposts' => 3
				);

				query_posts($args);

				$tagdiv_template_layout = new Tagdiv_Template_Layout( 'no_sidebar' );
				if ( have_posts() ) {

					while ( have_posts() ) : the_post();

						echo $tagdiv_template_layout->layout_open_element();

						global $post;
						$tagdiv_modul_1 = new Tagdiv_Module_1($post);
						echo $tagdiv_modul_1->render();

						echo $tagdiv_template_layout->layout_close_element();
						$tagdiv_template_layout->layout_next();

					endwhile;

					echo $tagdiv_template_layout->close_all_tags();
				}

				wp_reset_query();
				?>
			</div>
		</div> <!-- /.td-container -->
	</div> <!-- /.td-main-content-wrap -->
<?php
get_footer();
