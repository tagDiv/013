<?php
/**
 * Template Name: MeisterMag Homepage
 * This template is used for the display of landing pages.
 */

get_header();

global $paged,$post;

$tagdiv_page  = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; //rewrite the global var
$tagdiv_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //rewrite the global var

if ( $tagdiv_paged > $tagdiv_page ) {
    $paged = $tagdiv_paged;
} else {
    $paged = $tagdiv_page;
}

$tagdiv_home_latest_articles_title  = sanitize_text_field( Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_latest_section_title') );
$tagdiv_home_block_title            = sanitize_text_field( Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_block_section_title' ) );

?>

    <div class="tagdiv-main-content-wrap">
        <div class="tagdiv-container">

            <?php if ( empty( $paged ) or 2 > $paged ) { //show this only on the first page ?>

                <div class="tagdiv-row">
                    <div class="tagdiv-span12" role="main">
                        <?php
                        echo tagdiv_global_blocks::get_instance( 'Tagdiv_Block_1' )->render( array(
                            'tagdiv_custom_title'      => $tagdiv_home_block_title,
                            'tagdiv_block_posts_limit' => 3,
                            'tagdiv_column_number'     => 3,
                            'tagdiv_block_sort'        => 'random_posts',
                        ) );
                        ?>
                    </div>
                </div> <!-- /.tagdiv-row -->
            <?php } ?>

            <div class="tagdiv-row">
                <div class="tagdiv-span8" role="main">

                    <div class="tagdiv-block-title-wrap">
                        <h4 class="tagdiv-block-title">
                            <span><?php echo $tagdiv_home_latest_articles_title ?></span>
                        </h4>
                    </div>

                    <?php

                    // custom query parameters
                    $args = array(
                        'post_type'=> 'post',
                        'paged'    => $paged
                    );

                    // instantiate our custom query
                    $tagdiv_home_query = new WP_Query( $args );
                    $tagdiv_template_layout = new Tagdiv_Template_Layout( 'default' );

                    if ( $tagdiv_home_query->have_posts() ) {

                        while ( $tagdiv_home_query->have_posts() ) : $tagdiv_home_query->the_post();

                            echo $tagdiv_template_layout->layout_open_element();

                            $tagdiv_modul_1 = new Tagdiv_Module_1( $post );
                            echo $tagdiv_modul_1->render();

                            echo $tagdiv_template_layout->layout_close_element();
                            $tagdiv_template_layout->layout_next();

                        endwhile;

                        // reset postdata
                        wp_reset_postdata();

                        echo $tagdiv_template_layout->close_all_tags(); ?>

                    <?php

                    } else {
                        get_template_part( 'template-parts/content', 'none' );
                    }

                    ?>

                    <div class="page-nav">

                        <?php echo paginate_links( array(
                            'total' => $tagdiv_home_query->max_num_pages,
                        )  ); ?>

                    </div>

                </div>

                <div class="tagdiv-span4 tagdiv-sidebar" role="complementary">
                    <?php get_sidebar(); ?>
                </div>

            </div> <!-- /.tagdiv-row -->
        </div> <!-- /.tagdiv-container -->
    </div> <!-- /.tagdiv-main-content-wrap -->

<?php get_footer(); ?>