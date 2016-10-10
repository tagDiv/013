<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title tagdiv-page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content td-page-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-nav page-nav-post">',
			'after'       => '</div>',
			'link_before' => '<div>',
			'link_after'  => '</div>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tdmag' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
