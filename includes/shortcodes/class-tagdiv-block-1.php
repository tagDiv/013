<?php
class tagdiv_block_1 extends tagdiv_block {
    function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->tagdiv_query (it runs the query)

	    if (empty($tagdiv_column_number)) {
            $tagdiv_column_number = tagdiv_util::vc_get_column_number(); // get the column width of the block from the page builder API
        }

        $buffy = ''; //output buffer
        
        $buffy .= '<div class="' . $this->get_block_classes() . ' td-column-' . $tagdiv_column_number . '" ' . $this->get_block_html_atts() . '>';

        //get the block css
        $buffy .= $this->get_block_css();

        //get the js for this block
        $buffy .= $this->get_block_js();

        // block title wrap
        $buffy .= '<div class="td-block-title-wrap">';
            $buffy .= $this->get_block_title(); //get the block title
            $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
        $buffy .= '</div>';

        $buffy .= '<div id=' . $this->block_uid . ' class="tagdiv_block_inner">';
        $buffy .= $this->inner($this->tagdiv_query->posts);  //inner content of the block
        $buffy .= '</div>';

        //get the ajax pagination for this block
        $buffy .= $this->get_block_pagination();
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $tagdiv_column_number = '') {
        $buffy = '';

        $tagdiv_block_layout = new tagdiv_block_layout();
        if (empty($tagdiv_column_number)) {
            $tagdiv_column_number = tagdiv_util::vc_get_column_number(); // get the column width of the block from the page builder API
        }

        $tagdiv_post_count = 0; // the number of posts rendered
        $tagdiv_current_column = 1; //the current column

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $tagdiv_module_1 = new tagdiv_module_1($post);

                switch ($tagdiv_column_number) {

                    case '1': //one column layout
                        $buffy .= $tagdiv_module_1->render();
                        break;

                    case '2': //two column layout
                        $buffy .= $tagdiv_block_layout->open_row();
                        $buffy .= $tagdiv_block_layout->open6();
                        $buffy .= $tagdiv_module_1->render();
                        $buffy .= $tagdiv_block_layout->close6();

                        if ($tagdiv_current_column == 2) {
                            $buffy .= $tagdiv_block_layout->close_row();
                        }
                        break;

                    case '3': //three column layout
                        $buffy .= $tagdiv_block_layout->open_row();
                        $buffy .= $tagdiv_block_layout->open4();
                        $buffy .= $tagdiv_module_1->render();
                        $buffy .= $tagdiv_block_layout->close4();

                        if ($tagdiv_current_column == 3) {
                            $buffy .= $tagdiv_block_layout->close_row();
                        }
                        break;
                }

                //current column
                if ($tagdiv_current_column == $tagdiv_column_number) {
                    $tagdiv_current_column = 1;
                } else {
                    $tagdiv_current_column++;
                }

                $tagdiv_post_count++;
            }
        }
        $buffy .= $tagdiv_block_layout->close_all_tags();
        return $buffy;
    }
}