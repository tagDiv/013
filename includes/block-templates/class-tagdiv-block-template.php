<?php

/**
 * this is the default block template
 * Class tagdiv_block_header_1
 */
class Tagdiv_Block_Template_1 {

	/**
	 * @var string the template data, it's set on construct
	 */
	var $template_data_array = '';

	/**
	 * @param $template_data_array array - all the data for the template
	 */
	function __construct( $template_data_array ) {
		$this->template_data_array = $template_data_array;
	}

	/**
	 * renders the CSS for each block, each template may require a different css generated by the theme
	 * @return string CSS the rendered css and <style> block
	 */
	function get_css() {
		$header_color      = $this->template_data_array['atts']['header_color'];
		$header_text_color = $this->template_data_array['atts']['header_text_color'];


		// check if we have a header color, do nothing if we don't have a header_color or header_text_color
		if ( ( empty( $header_color ) or $header_color == '#' ) and ( empty( $header_text_color ) or $header_text_color == '#' ) ) {
			return '';
		}

		// $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
		$unique_block_class = $this->template_data_array['unique_block_class'];

		// the css that will be compiled by the block, <style> - will be removed by the compiler
		$raw_css = "
        <style>

            /* @header_text_color */
            .$unique_block_class .tagdiv_module_wrap:hover .entry-title a,
            .$unique_block_class .td-load-more-wrap a:hover,
        	.$unique_block_class .tagdiv_quote_on_blocks,
        	.$unique_block_class .td-wrapper-pulldown-filter .td-pulldown-filter-display-option:hover,
        	.$unique_block_class .td-wrapper-pulldown-filter a.td-pulldown-filter-link:hover,
        	.$unique_block_class .td-wrapper-pulldown-filter a.td-cur-simple-item,
            .$unique_block_class div .block-title span,
            .$unique_block_class div .block-title a,
            .$unique_block_class .td-module-comments a:hover,
            .$unique_block_class .td-next-prev-wrap a:hover,
            .$unique_block_class .td-authors-url a:hover,
            .$unique_block_class .tagdiv_authors_wrap:hover .td-authors-name a,
            .$unique_block_class .tagdiv_authors_wrap.td-active .td-authors-name a,
            .$unique_block_class .td-authors-url a:hover {
                color: @header_text_color;
            }

            .$unique_block_class .tagdiv_module_wrap .td-post-category:hover,
            .$unique_block_class .block-title:after,
            .$unique_block_class .entry-title:after,
            .$unique_block_class .td-wrapper-pulldown-filter .td-pulldown-filter-list:before {
                background-color: @header_text_color;
            }

            /* @header_color */
            .$unique_block_class .block-title span,
            .$unique_block_class .block-title a {
                background-color: @header_color;
                margin: 0;
                padding: 8px 10px;
                color: #fff;
            }
            .$unique_block_class .block-title:after {
                display: none;
            }
            .$unique_block_class .td-wrapper-pulldown-filter .td-pulldown-filter-list {
                margin-top: -2px;
            }
            .$unique_block_class .block-title {
                font-size: 13px;
                font-weight: 500;
                margin-bottom: 22px;
            }

            .$unique_block_class .tagdiv_module_wrap:hover .entry-title a,
            .$unique_block_class .td-load-more-wrap a:hover,
        	.$unique_block_class .tagdiv_quote_on_blocks,
        	.$unique_block_class .td-wrapper-pulldown-filter .td-pulldown-filter-display-option:hover,
        	.$unique_block_class .td-wrapper-pulldown-filter a.td-pulldown-filter-link:hover,
        	.$unique_block_class .td-wrapper-pulldown-filter a.td-cur-simple-item,
            .$unique_block_class .td-module-comments a:hover,
            .$unique_block_class .td-next-prev-wrap a:hover,
            .$unique_block_class .td-authors-url a:hover,
            .$unique_block_class .tagdiv_authors_wrap:hover .td-authors-name a,
            .$unique_block_class .tagdiv_authors_wrap.td-active .td-authors-name a,
            .$unique_block_class .td-authors-url a:hover {
                color: @header_color;
            }

            .$unique_block_class .tagdiv_module_wrap .td-post-category:hover,
            .$unique_block_class .entry-title:after,
            .$unique_block_class .td-wrapper-pulldown-filter .td-pulldown-filter-list:before {
                background-color: @header_color;
            }

        </style>
    ";

		$tagdiv_css_compiler = new Tagdiv_CSS_Compiler( $raw_css );
		$tagdiv_css_compiler->load_setting_raw( 'header_color', $header_color );
		$tagdiv_css_compiler->load_setting_raw( 'header_text_color', $header_text_color );

		$compiled_style = $tagdiv_css_compiler->compile_css();


		return $compiled_style;
	}

	/**
	 * renders the block title
	 * @return string HTML
	 */
	function get_block_title() {
		$custom_title = $this->template_data_array['atts']['custom_title'];
		$custom_url   = $this->template_data_array['atts']['custom_url'];

		if ( empty( $custom_title ) ) {
			if ( empty( $this->template_data_array['tagdiv_pull_down_items'] ) ) {
				//no title selected and we don't have pulldown items
				return '';
			}
			// we don't have a title selected BUT we have pull down items! we cannot render pulldown items without a block title
			$custom_title = 'Block title';
		}

		// there is a custom title
		$buffy = '';
		$buffy .= '<h4 class="block-title">';
		if ( ! empty( $custom_url ) ) {
			$buffy .= '<a href="' . esc_url( $custom_url ) . '">' . esc_html( $custom_title ) . '</a>';
		} else {
			$buffy .= '<span>' . esc_html( $custom_title ) . '</span>';
		}
		$buffy .= '</h4>';

		return $buffy;
	}


	/**
	 * renders the filter of the block
	 * @return string
	 */
	function get_pull_down_filter() {
		$buffy = '';

		if ( empty( $this->template_data_array['tagdiv_pull_down_items'] ) ) {
			return '';
		}

		$buffy .= '<div class="td-wrapper-pulldown-filter">';
		$buffy .= '<div class="td-pulldown-filter-display-option">';


		//show the default display value
		$buffy .= '<div id="td-pulldown-' . $this->template_data_array['block_uid'] . '-val"><span>';
		$buffy .= $this->template_data_array['tagdiv_pull_down_items'][0]['name'] . ' </span><i class="td-icon-down"></i>';
		$buffy .= '</div>';

		//builde the dropdown
		$buffy .= '<ul class="td-pulldown-filter-list">';
		foreach ( $this->template_data_array['tagdiv_pull_down_items'] as $item ) {
			$buffy .= '<li class="td-pulldown-filter-item"><a class="td-pulldown-filter-link" id="' . Tagdiv_Global::tagdiv_generate_unique_id() . '" data-tagdiv_filter_value="' . $item['id'] . '" data-tagdiv_block_id="' . $this->template_data_array['block_uid'] . '" href="#">' . $item['name'] . '</a></li>';
		}
		$buffy .= '</ul>';

		$buffy .= '</div>';  // /.td-pulldown-filter-display-option
		$buffy .= '</div>';

		return $buffy;
	}
}