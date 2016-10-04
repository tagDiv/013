<?php
/*  ----------------------------------------------------------------------------
    the attachment template
 */

get_header();

?>

<div class="td-main-content-wrap td-container-wrap">
    <div class="td-container">

        <div class="td-pb-row">
                    <div class="td-pb-span8 td-main-content">

                            <?php if ( is_single() ) { ?>

                                <h1 class="entry-title td-page-title">
                                <span><?php the_title(); ?></span>
                                </h1>

                            <?php  } else { ?>

                                <h1 class="entry-title td-page-title">
                                <a href="<?php ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                </h1>

                            <?php  }

                            $td_att_url = '';
                            $td_att_alt = '';

                            if (have_posts()) {
                                while ( have_posts() ) : the_post();

                                    if ( wp_attachment_is_image( $post->id ) ) {
                                        $td_att_image = wp_get_attachment_image_src( $post->id, 'full');

                                        if (!empty($td_att_image[0])) {
                                            $td_att_url = $td_att_image[0];
                                        }

                                        if (empty($td_att_image[0])) {
                                            $td_att_image[0] = ''; //init the variable to not have problems
                                        }

                                        $td_image_data = Tagdiv_Util::get_image_attachment_data($post->post_parent);
                                        if (!empty($td_image_data->alt)) {
                                            $td_att_alt = $td_image_data->alt;
                                        }

                                        ?>
                                        <a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img class="td-attachment-page-image" src="<?php echo $td_att_image[0];?>" alt="<?php echo $td_att_alt ?>" /></a>

                                        <div class="td-attachment-page-content">
                                            <?php the_content(); ?>
                                        </div>
                                        <?php
                                    }

                                endwhile; //end loop

                            } else {
                                get_template_part( 'template-parts/content', 'none' );
                            }

                            ?>

                            <div class="td-attachment-prev"><?php previous_image_link(); ?></div>
                            <div class="td-attachment-next"><?php next_image_link(); ?></div>

                    </div>
                    <div class="td-pb-span4 td-main-sidebar">
                            <?php get_sidebar(); ?>
                    </div>

        </div> <!-- /.td-pb-row -->
    </div> <!-- /.td-container -->
</div> <!-- /.td-main-content-wrap -->

<?php
get_footer();
?>