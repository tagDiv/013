<?php
/* Template Name: TAGDIV_THEME_NAME Homepage */

get_header();

global $paged,$post;

$td_page = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; //rewrite the global var
$td_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //rewrite the global var

//paged works on single pages, page - works on homepage
if ( $td_paged > $td_page ) {
    $paged = $td_paged;
} else {
    $paged = $td_page;
}

?>

    <div class="td-main-content-wrap td-container-wrap">
        <div class="td-container">

            <?php if ( empty( $paged ) or $paged < 2 ) { //show this only on the first page ?>

                <div class="td-pb-row">
                    <div class="td-pb-span12 td-main-content" role="main">
                        <?php
                        echo tagdiv_global_blocks::get_instance( 'Tagdiv_Block_1' )->render( array(
                            'limit'                => 3,
                            'sort'                 => '',
                            'post_ids'             => '',
                            'tag_slug'             => '',
                            'autors_id'            => '',
                            'installed_post_types' => '',
                            'category_id'          => '',
                            'category_ids'         => '',
                            'custom_title'         => get_option( 'tagdiv_block_settings_block_1_title' ),
                            'custom_url'           => '',
                            'tagdiv_column_number' => 3,
                            'offset'               => 2
                        ) ) ;
                        ?>
                    </div>
                </div> <!-- /.td-pb-row -->

                <div class="td-pb-row">
                    <div class="td-pb-span12">
                        <?php echo tagdiv_global_blocks::get_instance( 'Tagdiv_Block_Image_Box' )->render( array(
                            'custom_title'      => get_option( 'tagdiv_block_settings_image_block_title' ),
                            'style'             => 'style-2',

                            'image_item0'       => get_theme_mod( 'tagdiv_block_settings_image_item0' ),
                            'image_item1'       => get_theme_mod( 'tagdiv_block_settings_image_item1' ),
                            'image_item2'       => get_theme_mod( 'tagdiv_block_settings_image_item2' ),

                            'image_title_item0' => get_option( 'tagdiv_block_settings_image_item0_title' ),
                            'image_title_item1' => get_option( 'tagdiv_block_settings_image_item1_title' ),
                            'image_title_item2' => get_option( 'tagdiv_block_settings_image_item2_title' ),

                            'custom_url_item0'  => get_option( 'tagdiv_block_settings_image_item0_url' ),
                            'custom_url_item1'  => get_option( 'tagdiv_block_settings_image_item1_url' ),
                            'custom_url_item2'  => get_option( 'tagdiv_block_settings_image_item2_url' ),

                            'open_in_new_window_item0' => get_option( 'tagdiv_block_settings_image_item0_url_open' ),
                            'open_in_new_window_item1' => get_option( 'tagdiv_block_settings_image_item1_url_open' ),
                            'open_in_new_window_item2' => get_option( 'tagdiv_block_settings_image_item2_url_open' ),

                            'height'            => "360",
                            'gap'               => "5",
                            'display' 			=> '',
                            'alignment' 		=> '',

                        ) ); ?>
                    </div>
                </div> <!-- /.td-pb-row -->

            <?php } ?>

            <div class="td-container td-pb-article-list">
                <div class="td-pb-row">
                    <div class="td-pb-span8 td-main-content" role="main">

                        <div class="td-block-title-wrap">
                            <h4 class="block-title">
                                <span><?php _e( 'LATEST ARTICLES', 'tdmag' ) ?></span>
                            </h4>
                        </div>

                        <?php

                        $args = array(
                            'post_type'=> 'post',
                            'paged'    => $paged
                        );

                        query_posts( $args );
                        $tagdiv_template_layout = new Tagdiv_Template_Layout( 'default' );
                        if ( have_posts() ) {

                            while (have_posts()) : the_post();

                                echo $tagdiv_template_layout->layout_open_element();

                                $tagdiv_modul_1 = new Tagdiv_Module_1( $post );
                                echo $tagdiv_modul_1->render();

                                echo $tagdiv_template_layout->layout_close_element();
                                $tagdiv_template_layout->layout_next();

                            endwhile;

                            echo $tagdiv_template_layout->close_all_tags(); ?>


                            <div class="page-nav page-nav-post">

                                <?php
                                the_posts_pagination( array(
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tdmag' ) . ' </span>',
                                    'screen_reader_text' => __( 'Latest articles navigation' ),
                                ) );
                                ?>

                            </div>

                            <?php wp_reset_query(); ?>
                            <?php

                        } else {
                            get_template_part( 'template-parts/content', 'none' );
                        }
                        ?>

                    </div>

                    <div class="td-pb-span4 tagdiv-sidebar" role="complementary">
                        <?php get_sidebar(); ?>
                    </div>
                </div> <!-- /.td-pb-row -->
            </div> <!-- /.td-container -->

        </div> <!-- /.td-container -->
    </div> <!-- /.td-main-content-wrap -->

<?php get_footer(); ?>
