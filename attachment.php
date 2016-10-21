<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

get_header();

?>

<div class="td-main-content-wrap td-container-wrap">
    <div class="td-container">
        <div class="td-pb-row">
            <div class="td-pb-span8 td-main-content">

                <?php while ( have_posts() ) : the_post(); // Start the loop. ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <header class="tagdiv-page-header">
                            <?php the_title( '<h1 class="entry-title tagdiv-page-title">', '</h1>' ); ?>
                        </header><!-- .entry-header -->

                        <div class="entry-content">

                            <div class="entry-attachment">
                                <?php
                                /**
                                 * Filter the default twentysixteen image attachment size.
                                 *
                                 * @since TAGDIV_THEME_NAME 1.0
                                 *
                                 * @param string $image_size Image size. Default 'large'.
                                 */
                                $image_size = apply_filters( 'tagdiv_attachment_size', 'large' );

                                echo wp_get_attachment_image( get_the_ID(), $image_size );
                                ?>

                                <?php tagdiv_excerpt(); ?>

                            </div><!-- .entry-attachment -->

                            <div class="tagdiv-attachment-page-content">
                                <?php the_content(); ?>
                            </div>

                        </div><!-- .entry-content -->

                        <footer class="entry-footer">
                                <?php
                                wp_link_pages( array(
                                    'before' => '<div class="page-nav page-nav-post">',
                                    'after' => '</div>',
                                    'link_before' => '<div>',
                                    'link_after' => '</div>',
                                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tdmag' ) . ' </span>%',
                                    'separator'   => '<span class="screen-reader-text">, </span>',
                                ) );
                                ?>


                                <div class="tagdiv-attachment-prev"><?php previous_image_link(); ?></div>
                                <div class="tagdiv-attachment-next"><?php next_image_link(); ?></div>

                        </footer><!-- .entry-footer -->
                    </article><!-- #post-## -->

                    <?php endwhile; // End the loop. ?>

            </div>

            <div class="td-pb-span4 tagdiv-sidebar" role="complementary">
                    <?php get_sidebar(); ?>
            </div>
        </div> <!-- /.td-pb-row -->
    </div> <!-- /.td-container -->
</div> <!-- /.td-main-content-wrap -->

<?php get_footer();