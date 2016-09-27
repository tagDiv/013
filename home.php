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
                <div class="td-pb-span8 td-main-content">

                    <?php if ( have_posts() ) {

                        global $post;
                        $tagdiv_current_column = 2;
                        $tagdiv_template_layout = new Tagdiv_Block_Layout;
                        $tagdiv_modul_1 = new Tagdiv_Module_1($post);

                        while (have_posts()) : the_post();

                            $tagdiv_template_layout -> open_row();
                            $tagdiv_template_layout -> open6();
                            echo $tagdiv_modul_1->render();
                            $tagdiv_template_layout -> close6();
                            if ( $tagdiv_current_column == 2 ) {
                                $tagdiv_template_layout->close_row();
                            }

                        endwhile;

                        the_posts_navigation();

                    } else {
                        get_template_part( 'template-parts/content', 'none' );
                    } ?>

                </div>

                <div class="td-pb-span4 td-main-sidebar">

                    <?php get_sidebar(); ?>

                </div>

            </div> <!-- /.td-pb-row -->

        </div> <!-- /.td-container -->
    </div> <!-- /.td-main-content-wrap -->

<?php

get_footer();