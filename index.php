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


//echo tagdiv_global_blocks::get_instance('Tagdiv_Block_1')->render(array(
//	'custom_title' => 'ra',
//	'limit' => 4
//));
//echo 'works';
//die;

get_header(); ?>

	<div class="td-main-content-wrap td-container-wrap">
		<div class="td-container">
			<!--<div class="td-crumb-container">
				<?php /*echo td_page_generator::get_home_breadcrumbs(); */?>
			</div>-->

			<div class="td-pb-row">

				<div class="td-pb-span12 td-main-content">

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

							<?php
						endif;

//						echo '<pre>';
//						print_r(tagdiv_api_base::_debug_get_components_list());
//						print_r(get_post_format());
//						echo '</pre>';

						/* Start the Loop */
						while ( have_posts() ) : the_post(); ?>

						<div class="td-pb-span4">

						<?php	get_template_part( 'template-parts/content', get_post_format() ); ?>

						</div>

						<?php
						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</div>

			</div> <!-- /.td-pb-row -->
		</div> <!-- /.td-container -->
	</div> <!-- /.td-main-content-wrap -->



	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
