<?php
function tagdiv_css_generator() {

    $raw_css = "
    <style>
    /* @pagination */
    .page-nav a,
    .page-nav span {
    	@pagination
    }
    /* @dropcap */
    .td-theme-wrap .dropcap {
    	@dropcap
    }
    /* @default_widgets */
    .widget_archive a,
    .widget_calendar,
    .widget_categories a,
    .widget_nav_menu a,
    .widget_meta a,
    .widget_pages a,
    .widget_recent_comments a,
    .widget_recent_entries a,
    .widget_text .textwidget,
    .widget_tag_cloud a,
    .widget_search input,
    .widget_display_forums a,
    .widget_display_replies a,
    .widget_display_topics a,
    .widget_display_views a,
    .widget_display_stats,
    .widget_categories li span {
    	@default_widgets
    }
    /* @default_buttons */
	input[type=\"submit\"],
	.td-read-more a,
	.tagdiv_ajax_load_more,
	.vc_btn {
		@default_buttons
	}
	
	
	/* @body_text */
    body, p {
    	@body_text
    }
    </style>
    ";



    $tagdiv_css_compiler = new Tagdiv_CSS_Compiler($raw_css);


    //output the style
    return $tagdiv_css_compiler->compile_css();

}