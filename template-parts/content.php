<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>


<?php if ( is_single() ) { ?>

	<div class="td-post-template">

<?php } else {  ?>

	<div class="tagdiv-module-wrap td-module-wrap" >

<?php } ?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) { ?>

		<?php tagdiv_post_header(); // Post header. ?>
		<?php tagdiv_post_thumbnail(); // Post thumbnail. ?>

		<?php } else { ?>

		<?php tagdiv_post_thumbnail(); // Post thumbnail. ?>
		<?php tagdiv_post_header(); // Post header. ?>

	<?php } ?>

	<div class="entry-content">
		<?php if ( is_single() ) { ?>

			<div class="td-post-content">

				<?php /* translators: %s: Name of current post */
				the_content( sprintf(
					__td( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'tdmag' ),
					get_the_title()
				) );
				?>
			</div>

			<footer>

				<?php
				wp_link_pages( array(
					'before' => '<div class="page-nav page-nav-post">',
					'after' => '</div>',
					'link_before' => '<div>',
					'link_after' => '</div>',
					'separator'   => '<span class="screen-reader-text">, </span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tdmag' ) . ' </span>%',
				) );
				?>

				<div class="td-post-tags">
					<?php echo tagdiv_post_tags(); ?>
				</div>

			<?php echo tagdiv_next_prev_posts(); ?>
			<?php echo tagdiv_author_box(); ?>

			</footer>

		<?php } else { ?>

			<div class="entry-summary td-excerpt">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		<?php } ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
</div> <!-- .tagdiv-module /.td-post-template -->