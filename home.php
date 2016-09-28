<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 9/27/2016
 * Time: 3:09 PM
 */

get_header(); ?>

    <div class="td-main-content-wrap td-container-wrap">
        <div class="td-container">

            <div class="td-crumb-container">
                <?php //echo td_page_generator::get_home_breadcrumbs(); ?>
            </div>

            <div class="td-pb-row">
                <div class="td-pb-span8 td-main-content" role="main">
                    <?php
                    echo tagdiv_global_blocks::get_instance('Tagdiv_Block_1')->render(array(
                    	'custom_title' => 'Block I',
                    	'limit' => 2,
                        'tagdiv_column_number' => 2
                    ));
                    ?>
                </div>
                <div class="td-pb-span4 td-main-sidebar" role="complementary">
                    <?php //get_sidebar(); ?>
                </div>
            </div> <!-- /.td-pb-row -->

            <div class="td-pb-row">
                <div class="td-pb-span12">

                    <?php echo tagdiv_global_blocks::get_instance('Tagdiv_Block_Image_Box')->render(array(

                        'display' => '',
                        'style' => 'style-2',

                        'image_item0' => "http://192.168.0.120/wp_012/wp-content/uploads/2016/08/travel-2.jpg",
                        'image_item1' => "http://192.168.0.120/wp_012/wp-content/uploads/2016/08/travel-1.jpg",
                        'image_item2' => "http://192.168.0.120/wp_012/wp-content/uploads/2016/08/travel-3.jpg",

                        'gap' => "5",

                        'image_title_item0' => "Inland Wonders",
                        'image_title_item1'=> "City Breaks",
                        'image_title_item2' => "Sea Adventures",

                        'custom_url_item0' => "#",
                        'custom_url_item1' => "#",
                        'custom_url_item2' => "#",

                        'height' => "360"

                    )); ?>

                </div>
            </div> <!-- /.td-pb-row -->

            <div class="td-container td-pb-article-list">
                <div class="td-pb-row">

                    <div class="td-pb-span8 td-main-content" role="main">
                        <div class="td-ss-main-content">
                            <div class="td-block-title-wrap">
                                <h4 class="block-title">
                                    <span><?php echo __td('LATEST ARTICLES', TAGDIV_THEME_NAME) ?></span>
                                </h4>
                            </div>

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
                    </div>
                    <div class="td-pb-span4 td-main-sidebar" role="complementary">
                        <?php get_sidebar(); ?>
                    </div>

                </div> <!-- /.td-pb-row -->
            </div> <!-- /.td-container -->

        </div> <!-- /.td-container -->
    </div> <!-- /.td-main-content-wrap -->

<?php

get_footer();