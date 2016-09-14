<?php
class Tagdiv_Util {


    private static $authors_array_cache = ''; //cache the results from  create_array_authors


	private static $theme_options_is_shutdown_hooked = false; /** flag used by @see Tagdiv_Util::update_option to hook only once on shutdown hook */





    /**
     * reads a theme option from wp
     * @param $optionName
     * @param string $default_value
     * @return string|array
     */
    static function get_option($optionName, $default_value = '') {
        //$theme_options = get_option(tagdiv_THEME_OPTIONS_NAME);

        if (!empty(Tagdiv_Global::$tagdiv_options[$optionName])) {
            return Tagdiv_Global::$tagdiv_options[$optionName];
        } else {
            if (!empty($default_value)) {
                return $default_value;
            } else {
                return '';
            }
        }
    }

    //updates a theme option @todo sa updateze globala tagdiv_util::$tagdiv_options
    static function update_option($optionName, $newValue) {
        Tagdiv_Global::$tagdiv_options[$optionName] = $newValue;

	    //  hook the shutdown action only once - on shutdown we save the theme settings to the DB
	    if (self::$theme_options_is_shutdown_hooked === false) {
		    add_action('shutdown', array(__CLASS__, 'on_shutdown_save_theme_options'));
		    self::$theme_options_is_shutdown_hooked = true;
	    }
    }



	// hook used to save the theme options to the database on update
	static function on_shutdown_save_theme_options() {
		update_option(tagdiv_THEME_OPTIONS_NAME, Tagdiv_Global::$tagdiv_options);
	}




    /*
     * gets the blog page url (only if the blog page is configured in theme customizer)
     */
    static function get_home_url() {
        if( get_option('show_on_front') == 'page') {
            $posts_page_id = get_option( 'page_for_posts');
            return esc_url(get_permalink($posts_page_id));
        } else {
            return false;
        }
    }


    //gets the sidebar setting or default if no sidebar is selected for a specific setting id
    static function show_sidebar($template_id) {
        $tds_cur_sidebar = Tagdiv_Util::get_option( 'tds_' . $template_id . '_sidebar');
        if (!empty($tds_cur_sidebar)) {
            dynamic_sidebar($tds_cur_sidebar);
        } else {
            //show default
            if (!dynamic_sidebar(tagdiv_THEME_NAME . ' default')) {
                ?>
                <!-- .no sidebar -->
                <?php
            }
        }
    }


    static function get_image_attachment_data($post_id, $size = 'tagdiv_180x135', $count = 1 ) {//'thumbnail'
        $objMeta = array();
        $meta = '';// (stdClass)
        $args = array(
            'numberposts' => $count,
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'nopaging' => false,
            'post_mime_type' => 'image',
            'order' => 'ASC', // change this to reverse the order
            'orderby' => 'menu_order ID', // select which type of sorting
            'post_status' => 'any'
        );

        $attachments = get_children($args);

        if ($attachments) {
            foreach ($attachments as $attachment) {
                $meta = new stdClass();
                $meta->ID = $attachment->ID;
                $meta->title = $attachment->post_title;
                $meta->caption = $attachment->post_excerpt;
                $meta->description = $attachment->post_content;
                $meta->alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

                // Image properties
                $props = wp_get_attachment_image_src( $attachment->ID, $size, false );

                $meta->properties['url'] = $props[0];
                $meta->properties['width'] = $props[1];
                $meta->properties['height'] = $props[2];

                $objMeta[] = $meta;
            }

            return ( count( $attachments ) == 1 ) ? $meta : $objMeta;
        }
    }






    /**
     * returns a string containing the numbers of words or chars for the content
     *
     * @param $post_content - the content thats need to be cut
     * @param $limit        - limit to cut
     * @param string $show_shortcodes - if shortcodes
     * @return string
     */
    static function excerpt($post_content, $limit, $show_shortcodes = '') {
        //REMOVE shortscodes and tags
        if ($show_shortcodes == '') {
	        // strip_shortcodes(); this remove all shortcodes and we don't use it, is nor ok to remove all shortcodes like dropcaps
	        // this remove the caption from images
	        $post_content = preg_replace("/\[caption(.*)\[\/caption\]/i", '', $post_content);
	        // this remove the shortcodes but leave the text from shortcodes
            $post_content = preg_replace('`\[[^\]]*\]`','',$post_content);
        }

        $post_content = stripslashes(wp_filter_nohtml_kses($post_content));

        /*only for problems when you need to remove links from content; not 100% bullet prof
        $post_content = htmlentities($post_content, null, 'utf-8');
        $post_content = str_replace("&nbsp;", "", $post_content);
        $post_content = html_entity_decode($post_content, null, 'utf-8');

        //$post_content = preg_replace('(((ht|f)tp(s?)\://){1}\S+)','',$post_content);//Radu A
        $pattern = "/[a-zA-Z]*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i";//radu o
        $post_content = preg_replace($pattern,'',$post_content);*/

	    // remove the youtube link from excerpt
	    //$post_content = preg_replace('~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i', '', $post_content);

        //excerpt for letters
        if ( Tagdiv_Util::get_option('tds_excerpts_type') == 'letters') {

            $ret_excerpt = mb_substr($post_content, 0, $limit);
            if (mb_strlen($post_content)>=$limit) {
                $ret_excerpt = $ret_excerpt.'...';
            }

            //excerpt for words
        } else {
            /*removed and moved to check this first thing when reaches thsi function
             * if ($show_shortcodes == '') {
                $post_content = preg_replace('`\[[^\]]*\]`','',$post_content);
            }

            $post_content = stripslashes(wp_filter_nohtml_kses($post_content));*/

            $excerpt = explode(' ', $post_content, $limit);




            if (count($excerpt)>=$limit) {
                array_pop($excerpt);
                $excerpt = implode(" ",$excerpt).'...';
            } else {
                $excerpt = implode(" ",$excerpt);
            }


            $excerpt = esc_attr(strip_tags($excerpt));



            if (trim($excerpt) == '...') {
                return '';
            }

            $ret_excerpt = $excerpt;
        }
        return $ret_excerpt;
    }



    static function vc_set_column_number($tagdiv_columns) {
        global $tagdiv_row_count, $tagdiv_column_count;
        $tagdiv_row_count = 1;

        switch ($tagdiv_columns) {
            case '1':
                $tagdiv_column_count = '1/3';
                break;
            case '2':
                $tagdiv_column_count = '2/3';
                break;
            case '3':
                $tagdiv_column_count = '1/1';
                break;

        }
    }



    /**
     * receives a VC_MAP array and it removes param_name's from it
     * @param $vc_map_array array contains a VC_MAP array - must have a ex: $vc_map_array[0]['param_name']
     * @param $param_names array of param_name's that we will cut from the VC_MAP array
     * @return array the cut VC_MAP array
     */
    static function vc_array_remove_params($vc_map_array, $param_names) {
        foreach ($vc_map_array as $vc_map_index => $vc_map) {
            if (in_array($vc_map['param_name'], $param_names)) {
	            unset($vc_map_array[$vc_map_index]);
            }
        }
	    // the array_merge is used to remove unset int keys and reindex the array for int keys, preserving string keys - Visual Composer needs this
        return array_merge($vc_map_array);
    }



    /**
     * tries to determine on how many td-columns a block is  (1, 2 or 3)
     * $tagdiv_row_count, $tagdiv_column_count are from the pagebuilder
     * @return int
     */
    static function vc_get_column_number() {
        global $tagdiv_row_count, $tagdiv_column_count, $post;

        //echo 'xxxxx col: ' . $tagdiv_column_count . ' row: ' . $tagdiv_row_count;
        $columns = 1;//number of column

        if ($tagdiv_row_count == 1) {
            //first row
            switch ($tagdiv_column_count) {
                case '1/1':
                    $columns = 3;
                    break;

                case '2/3' :
                    $columns = 2;
                    break;

                case '1/3' :
                    $columns = 1;
                    break;

                case '1/2': //half a row + sidebar
                    $columns = 2;
                    break;
            }
        } else {
            //row in row
            if ($tagdiv_column_count == '1/2') {
                $columns = 1;
            }

            if ($tagdiv_column_count == '1/3') {
                // works if parent is empty (1/1)
                $columns = 1;
            }
        }


        /**
         * we are on 'page-title-sidebar' template here
         * we have to recalculate the columns to account for the optional sidebar of the template
         */
        if( Tagdiv_Global::$current_template == 'page-title-sidebar'){
            $tagdiv_page = get_post_meta($post->ID, 'tagdiv_page', true);

            //check for this page sidebar position
            if (!empty($tagdiv_page['tagdiv_sidebar_position'])) {
                $sidebar_position_pos = $tagdiv_page['tagdiv_sidebar_position'];
            } else {
                //if sidebar position is set to default, then check the Default Sidebar Position (from Theme Panel - Template Settings - Page template)
                $sidebar_position_pos = Tagdiv_Util::get_option('tds_page_sidebar_pos');
            }

            switch ($sidebar_position_pos) {
                case 'sidebar_right':
                case 'sidebar_left':
                case '':
                    // if we are in the sidebar and on page-title-sidebar do not make the $columns = 1-1 > 0
                    if ($columns != 1) {
                        $columns = $columns - 1;
                    }

                    break;

                case 'no_sidebar':
                    if($columns < 3) {
                        //
                    } else {
                        $columns = 3;
                    }
                    break;
            }//end switch
        } //end if  page-title-sidebar

        //default
        return $columns;
    }



    static function get_featured_image_src($post_id, $thumb_type) {
        $attachment_id = get_post_thumbnail_id($post_id);
        $tagdiv_temp_image_url = wp_get_attachment_image_src($attachment_id, $thumb_type);

        if (!empty($tagdiv_temp_image_url[0])) {
            return $tagdiv_temp_image_url[0];
        } else {
            return '';
        }
    }


    /**
     * get information about an attachment
     * @param $attachment_id
     * @param string $thumbType
     * @return array
     */
    static function attachment_get_full_info($attachment_id, $thumbType = 'full') {
        $attachment = get_post( $attachment_id );

        // make sure that we get a post
        if (is_null($attachment)) {
            return array (
                'alt' => '',
                'caption' => '',
                'description' => '',
                'href' => '',
                'src' => '',
                'title' => '',
                'width' => '',
                'height' => ''
            );
        }

        $image_src_array = self::attachment_get_src($attachment_id, $thumbType);

        //print_r($attachment);

        return array (
            'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => esc_url(get_permalink($attachment->ID)),
            'src' => $image_src_array['src'],
            'title' => $attachment->post_title,
            'width' => $image_src_array['width'],
            'height' => $image_src_array['height']
        );
    }


    /**
     * Safe way to get an attachment image src + width and height. It always returns the array
     * @param $attachment_id
     * @param string $thumbType
     * @return mixed
     */
    static function attachment_get_src($attachment_id, $thumbType = 'full') {
        $image_src_array = wp_get_attachment_image_src($attachment_id, $thumbType);
        $buffy = array();

        //init the variable returned from wp_get_attachment_image_src
        if (empty($image_src_array[0])) {
            $buffy['src'] = '';
        } else {
            $buffy['src'] = $image_src_array[0];
        }

        if (empty($image_src_array[1])) {
            $buffy['width'] = '';
        } else {
            $buffy['width'] = $image_src_array[1];
        }


        if (empty($image_src_array[2])) {
            $buffy['height'] = '';
        } else {
            $buffy['height'] = $image_src_array[2];
        }

        return $buffy;
    }



    static function strpos_array($haystack_string, $needle_array, $offset=0) {
        foreach($needle_array as $query) {
            if(strpos($haystack_string, $query, $offset) !== false) {
                return true; // stop on first true result
            }
        }
        return false;
    }





    /**
     * register the thumbs with WordPress only when the thumbs are enabled form the panel
     * @param $id
     * @param $x
     * @param $y
     * @param $crop
     */
    static function add_image_size_if_enabled($id, $x, $y, $crop) {
        if ( Tagdiv_Util::get_option( 'tds_thumb_' . $id) != '') {
            add_image_size($id, $x, $y, $crop);
        }
    }






    /**
     * Shows a soft error. The site will run as usual if possible. If the user is logged in and has 'switch_themes'
     * privileges this will also output the caller file path
     * @param $file - The file should be __FILE__
     * @param $message
     */
    static function error($file, $message, $more_data = '') {
        echo '<br><br>wp booster error:<br>';
        echo $message;
        if (is_user_logged_in() and current_user_can('switch_themes')){
            echo '<br>' . $file;
            if (!empty($more_data)) {
                echo '<br><br><pre>';
                echo 'more data:' . PHP_EOL;
                print_r($more_data);
                echo '</pre>';
            }
        };
    }


    /**
     * makes sure that we return something even if the $_POST of that value is not defined
     * @param $post_variable
     * @return string
     */
    static function get_http_post_val($post_variable) {
        if (isset($_POST[$post_variable])) {
            return $_POST[$post_variable];
        } else {
            return '';
        }
    }


	/**
	 * replace script tag from the parameter $buffer   keywords: js javascript ob_start ob_get
	 * @param $buffer string
	 *
	 * @return string
	 */
	static function remove_script_tag($buffer) {
		return str_replace(array("<script>", "</script>", "<script type='text/javascript'>"), '', $buffer);
	}



	/**
	 * Checks if a demo is loaded. If one is loaded the function returns the demo NAME/ID. If no demo is loaded we get FALSE
	 * @see tagdiv_demo_state::update_state
	 * @return bool|string - false if no demo is loaded OR string - the demo id
	 */
	static function get_loaded_demo_id() {
		$demo_state = get_option(tagdiv_THEME_NAME . '_demo_state');  // get the current loaded demo... from wp cache
		if (!empty($demo_state['demo_id'])) {
			return $demo_state['demo_id'];
		}

		return false;
	}



    /**
     * Returns the srcset and sizes parameters or an empty string
     * @param $thumb_id - thumbnail id
     * @param $thumb_type - thumbnail name/type (ex. tagdiv_356x220)
     * @param $thumb_width - thumbnail width
     * @param $thumb_url - thumbnail url
     * @return string
     */
	static function get_srcset_sizes($thumb_id, $thumb_type, $thumb_width, $thumb_url) {
        $return_buffer = '';
        //retina srcset and sizes
        if ( Tagdiv_Util::get_option( 'tds_thumb_' . $thumb_type . '_retina') == 'yes' && !empty($thumb_width)) {
            $thumb_w = ' ' . $thumb_width . 'w';
            $retina_thumb_width = $thumb_width * 2;
            $retina_thumb_w = ' ' . $retina_thumb_width . 'w';
            //retrieve retina thumb url
            $retina_url = wp_get_attachment_image_src($thumb_id, $thumb_type . '_retina');
            //srcset and sizes
            if ($retina_url !== false) {
                $return_buffer .= ' srcset="' . $thumb_url . $thumb_w . ', ' . $retina_url[0] . $retina_thumb_w . '" sizes="(-webkit-min-device-pixel-ratio: 2) ' . $retina_thumb_width . 'px, (min-resolution: 192dpi) ' . $retina_thumb_width . 'px, (max-width: 768px) ' . $retina_thumb_width . 'px, ' . $thumb_width . 'px"';
            }

        //responsive srcset and sizes
        } else {
            $thumb_srcset = wp_get_attachment_image_srcset($thumb_id, $thumb_type);
            $thumb_sizes = wp_get_attachment_image_sizes($thumb_id, $thumb_type);
            if ($thumb_srcset !== false && $thumb_sizes !== false) {
                $return_buffer .=  ' srcset="' . $thumb_srcset . '" sizes="' . $thumb_sizes . '"';
            }
        }

        return $return_buffer;
    }

}//end class tagdiv_util




