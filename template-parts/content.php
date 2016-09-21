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


<div class="tagdiv-module td-module-wrap" >
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		tagdiv_post_thumbnail();
	?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h3 class="entry-title td-module-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="td-module-meta-info">

		<span class="td-post-author-name">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a>
 		<span>-</span>
		</span>

		<span class="td-post-date">
		<time class="entry-date updated td-module-date" datetime="<?php echo date( DATE_W3C, get_the_time( 'U', get_the_ID() ) ); ?>" ><?php echo get_the_time( get_option( 'date_format' ), get_the_ID() ); ?></time>
		</span>

		<div class="td-module-comments">
		<a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo get_comments_number( get_the_ID() ); ?></a>
		</div>

	</div>

	<div class="entry-content">
		<?php

		if ( is_single() ) :
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'twentyfifteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		else : ?>
		<div class="entry-summary td-excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php endif; ?>

	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<!--<footer class="entry-footer">
		<?php /*//twentyfifteen_entry_meta(); */?>
		<?php /*edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); */?>
	</footer>--><!-- .entry-footer -->

</article><!-- #post-## -->
</div> <!-- .tagdiv-module -->