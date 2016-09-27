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

	<div class="tagdiv-module td-module-wrap" >

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
					__( 'Continue reading %s', 'twentyfifteen' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
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
					'nextpagelink'     => '<i class="td-icon-menu-right"></i>',
					'previouspagelink' => '<i class="td-icon-menu-left"></i>'
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

	<?php
/*		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	*/
	?>

	<!--<footer class="entry-footer">
		<?php /*//twentyfifteen_entry_meta(); */?>
		<?php /*edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); */?>
	</footer>--><!-- .entry-footer -->

</article><!-- #post-## -->
</div> <!-- .tagdiv-module /.td-post-template -->