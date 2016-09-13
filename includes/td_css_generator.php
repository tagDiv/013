<?php
function td_css_generator() {

    $raw_css = "
    <style>
    /* ------------------------------------------------------ */
    /* tagDiv Free Theme */

    /* ------------------------------------------------------ */
    /* GENERAL Theme Colors */

    /* THEME ACCENT COLOR */
    /* @theme_color */
    .td-icon-search,
    .td-header-wrap .td-drop-down-search .btn:hover,
    .td-header-wrap .td-drop-down-search .result-msg a,
    .td-header-top-menu .top-header-menu a:hover,
    .td-header-top-menu .top-header-menu .current-menu-item > a,
    .td-header-top-menu .top-header-menu .current-menu-ancestor > a,
    .td-header-top-menu .top-header-menu .current-category-ancestor > a,
    .sf-menu > li:hover > a,
    .sf-menu > .sfHover > a,
    .sf-menu > .current-menu-item > a,
    .sf-menu > .current-menu-ancestor > a,
    .sf-menu > .current-category-ancestor > a,
    .sf-menu ul .td-menu-item > a:hover,
    .sf-menu ul .sfHover > a,
    .sf-menu ul .current-menu-ancestor > a,
    .sf-menu ul .current-category-ancestor > a,
    .sf-menu ul .current-menu-item > a,
    .td_mega_menu_sub_cats .cur-sub-cat,
    .td_module_mega_menu:hover .entry-title a,
    .td-header-menu-search .td-search-btns-wrap:hover .td-icon-search,
    a,
    cite a:hover,
    .td-theme-wrap blockquote p,
    .td_module_wrap:hover .entry-title a,
    .td-next-prev-wrap a:hover,
    .td_ajax_load_more:hover,
    .td-wrapper-pulldown-filter .td-pulldown-filter-display-option:hover,
    .td-module-comments a:hover,
    .td-post-comments a:hover,
    .td-wrapper-pulldown-filter .td-pulldown-filter-item .td-cur-simple-item,
    .td-wrapper-pulldown-filter .td-pulldown-filter-link:hover,
    .td-wrapper-pulldown-filter .td-pulldown-category-filter-link:hover,
    .td_quote_on_blocks,
    .td_block_author a:hover,
    .td-social-sharing-buttons:hover .td-social-but-text,
    .td-post-small-box a:hover,
    .td-post-next-prev-content span,
    .td-post-next-prev-content a:hover,
    .td-author-name a:hover,
    .td-author-url a:hover,
    .td-related-title a:hover,
    .td-related-title .td-cur-simple-item,
    .logged-in-as a:hover,
    .comment-reply-link,
    #cancel-comment-reply-link:hover,
    #searchsubmit:hover,
    .search-submit:hover,
    .td-search-header .td-search-query,
    .td-review-overall i,
    .td-review-final-score,
    .widget a:hover,
    .widget_calendar tfoot a:hover,
    .widget_calendar tbody a,
    .td_social_type .td_social_button a:hover,
    .td-subfooter-menu li.menu-item > a:hover,
    .td-subfooter-menu li.sfHover > a,
    .td-subfooter-menu li.current-menu-ancestor > a,
    .td-subfooter-menu li.current-category-ancestor > a,
    .td-subfooter-menu li.current-menu-item > a,
    .td-mega-menu-page .wpb_content_element ul li a :hover,
    .td-smart-list-dropdown-wrap .td-smart-list-button:hover,
    .td-instagram-user a,
    .footer-email-wrap a,
    .td-sub-footer-copy i,
    .td_mod_related_posts:hover .entry-title > a,
    .td-footer-outer-wrapper a:hover,
    .td_block_authors .td_authors_wrap:hover .td-authors-name a,
    .td_block_authors .td_authors_wrap.td-active .td-authors-name a,
    .td_block_authors .td-authors-url a:hover,
    .widget .current-menu-item a,
    .td-tags span,
    .widget_categories li:hover a {
      color: @theme_color;
    }

    input[type=submit]:hover,
    .td-theme-wrap .dropcap,
    .entry-title:after,
    .td-post-category:hover,
    .block-title:after,
    .td-wrapper-pulldown-filter .td-pulldown-filter-list:before,
    .td_block_author .td-author-name:after,
    .td-a-rec-id-sidebar .td-adspot-title:after,
    .td-g-rec-id-sidebar .td-adspot-title:after,
    .single-post .page-nav > div,
    .td-category a:hover,
    .td-post-source-via:before,
    .td-author-name:after,
    .td-related-title .td-cur-simple-item:after,
    .td-comments-title-wrap h4:after,
    .comment-reply-title:after,
    .page-nav .current,
    .td-404-title:after,
    .td-rating-bar-wrap div,
    .widget_calendar #today,
    .td_social_type:hover .td-sp:before,
    .td-smart-list-button:hover {
      background-color: @theme_color;
    }
    
    @media (min-width: 1019px) {
      .td-big-grids .td-big-grid-post:hover .td-post-category {
        background-color: @theme_color;
      }
    }
    
    .td-theme-wrap .td_quote_box,
    .widget_calendar #today,
    .td-tags span,
    .widget_categories li:hover a span:before {
      border-color: @theme_color;
    }
    
    
    /* BACKGROUND COLOR */
    /* @site_background_color */
    body {
      background-color: @site_background_color;
    }


    /* BLOCK HEADER TEXT COLOR */
    /* @text_header_color */
    div .block-title label,
    div .block-title span,
    div .block-title a {
      color: @text_header_color;
    }
    .block-title:after {
      background-color: @text_header_color;
    }

    
    /* BLOCK HEADER BACKGROUND COLOR */
    /* @header_color */
    .block-title label,
    .block-title span,
    .block-title a {
      background-color: @header_color;
      margin: 0;
      padding: 8px 10px;
      color: #fff;
    }
    .block-title:after {
      display: none;
    }
    .td-wrapper-pulldown-filter .td-pulldown-filter-list {
      margin-top: -2px;
    }
    .block-title {
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 22px;
    }


    /* ------------------------------------------------------ */
    /* Top Menu Colors */
    
    /* TOP MENU BACKGROUND COLOR */
    /* @top_menu_color */
    .td-header-top-menu {
      background-color: @top_menu_color;
    }
    
    /* TOP MENU TEXT COLOR */
    /* @top_menu_text_color */
    .td-header-top-menu,
    .td-header-top-menu a {
      color: @top_menu_text_color;
    }
    
    /* TOP MENU TEXT HOVER COLOR */
    /* @top_menu_text_hover_color */
    .td-header-top-menu .top-header-menu a:hover,
    .td-header-top-menu .top-header-menu .current-menu-item > a,
    .td-header-top-menu .top-header-menu .current-menu-ancestor > a,
    .td-header-top-menu .top-header-menu .current-category-ancestor > a,
    .td-icon-search {
      color: @top_menu_text_hover_color;
    }
    
    /* TOP MENU SOCIAL ICONS COLOR */
    /* @top_social_icons_color */
    .td-header-sp-top-widget .td-social-icon-wrap a {
      color: @top_social_icons_color;
    }
    
    /* TOP MENU SOCIAL ICONS HOVER COLOR */
    /* @top_social_icons_hover_color */
    .td-header-sp-top-widget .td-social-icon-wrap:hover i {
      color: @top_social_icons_hover_color;
    }


    /* ------------------------------------------------------ */
    /* Main Menu Colors */
    
    /* MENU BACKGROUND COLOR */
    /* @menu_color */
    .td-theme-wrap .td-header-menu-wrap {
      background-color: @menu_color;
    }
    .td-header-menu-wrap:before,
    .td-header-menu-wrap:after {
      display: none;
    }
    .sf-menu ul ul {
      margin-top: -15px;
      padding: 15px 0;
    }

    /* MENU TEXT COLOR */
    /* @menu_text_color */
    .sf-menu > li > a,
    .td-header-main-menu .td-search-btns-wrap .td-icon-search {
      color: @menu_text_color;
    }
    
    /* MENU ACTIVE & HOVER COLOR */
    /* @submenu_hover_color */
    .sf-menu > li:hover > a,
    .sf-menu > .sfHover > a,
    .sf-menu > .current-menu-item > a,
    .sf-menu > .current-menu-ancestor > a,
    .sf-menu > .current-category-ancestor > a,
    .sf-menu ul .td-menu-item > a:hover,
    .sf-menu ul .sfHover > a,
    .sf-menu ul .current-menu-ancestor > a,
    .sf-menu ul .current-category-ancestor > a,
    .sf-menu ul .current-menu-item > a,
    .td_mega_menu_sub_cats .cur-sub-cat,
    .td_module_mega_menu:hover .entry-title a,
    .td-header-main-menu .td-search-btns-wrap:hover .td-icon-search {
      color: @submenu_hover_color;
    }
    .td-mega-menu-page .wpb_content_element ul li a:hover {
      color: @submenu_hover_color !important;
    }
    .td-header-main-menu .td-post-category:hover {
      background-color: @submenu_hover_color;
    }


    /* ------------------------------------------------------ */
    /* MOBILE MENU / MOBILE SEARCH COLORS */
    /* @mobile_menu_color */
    @media (max-width: 767px) {
        .td-header-wrap .td-header-main-menu {
            background-color: @mobile_menu_color !important;
        }
    }

    /* @mobile_icons_color */
    @media (max-width: 767px) {
        #td-top-mobile-toggle i,
        .td-header-menu-search i {
            color: @mobile_icons_color !important;
        }
    }

    /* @mobile_background_color */
    .td-menu-background:before,
    .td-search-background:before {
        background: @mobile_background_color;
    }
    
    /* @mobile_gradient_one_mob */
    .td-menu-background:before,
    .td-search-background:before {
        background: @mobile_gradient_one_mob;
        background: -moz-linear-gradient(top, @mobile_gradient_one_mob 0%, @mobile_gradient_two_mob 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, @mobile_gradient_one_mob), color-stop(100%, @mobile_gradient_two_mob));
        background: -webkit-linear-gradient(top, @mobile_gradient_one_mob 0%, @mobile_gradient_two_mob 100%);
        background: -o-linear-gradient(top, @mobile_gradient_one_mob 0%, @mobileu_gradient_two_mob 100%);
        background: -ms-linear-gradient(top, @mobile_gradient_one_mob 0%, @mobile_gradient_two_mob 100%);
        background: linear-gradient(to bottom, @mobile_gradient_one_mob 0%, @mobile_gradient_two_mob 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='@mobile_gradient_one_mob', endColorstr='@mobile_gradient_two_mob', GradientType=0 );
    }

    /* @mobile_text_active_color */
    .td-mobile-content .current-menu-item > a,
    .td-mobile-content .current-menu-ancestor > a,
    .td-mobile-content .current-category-ancestor > a,
    #td-mobile-nav .td-menu-login-section a:hover,
    #td-mobile-nav .td-register-section a:hover,
    #td-mobile-nav .td-menu-socials-wrap a:hover i,
    .td-search-close a:hover i {
        color: @mobile_text_active_color;
    }

    /* @mobile_button_background_mob */
    #td-mobile-nav .td-register-section .td-login-button,
    .td-search-wrap-mob .result-msg a {
        background-color: @mobile_button_background_mob;
    }

    /* @mobile_button_color_mob */
    #td-mobile-nav .td-register-section .td-login-button,
    .td-search-wrap-mob .result-msg a {
        color: @mobile_button_color_mob;
    }

    /* @mobile_text_color */
    .td-mobile-content li a,
    .td-mobile-content .td-icon-menu-right,
    .td-mobile-content .sub-menu .td-icon-menu-right,
    #td-mobile-nav .td-menu-login-section a,
    #td-mobile-nav .td-menu-logout a,
    #td-mobile-nav .td-menu-socials-wrap .td-icon-font,
    .td-mobile-close .td-icon-close-mobile,
    .td-search-close .td-icon-close-mobile,
    .td-search-wrap-mob,
    .td-search-wrap-mob #td-header-search-mob,
    #td-mobile-nav .td-register-section,
    #td-mobile-nav .td-register-section .td-login-input,
    #td-mobile-nav label,
    #td-mobile-nav .td-register-section i,
    #td-mobile-nav .td-register-section a,
    #td-mobile-nav .td_display_err,
    .td-search-wrap-mob .td_module_wrap .entry-title a,
    .td-search-wrap-mob .td_module_wrap:hover .entry-title a,
    .td-search-wrap-mob .td-post-date {
        color: @mobile_text_color;
    }
    .td-search-wrap-mob .td-search-input:before,
    .td-search-wrap-mob .td-search-input:after,
    #td-mobile-nav .td-menu-login-section .td-menu-login span {
        background-color: @mobile_text_color;
    }
    #td-mobile-nav .td-menu-logout a:before {
        border-color: @mobile_text_color;
    }

    #td-mobile-nav .td-register-section .td-login-input {
        border-bottom-color: @mobile_text_color !important;
    }

    /* @mobile_background_image */
    .td-menu-background,
    .td-search-background {
        background-image: url('@mobile_background_image');
    }

    /* @mobile_background_repeat */
    .td-menu-background,
    .td-search-background {
        background-repeat: @mobile_background_repeat;
    }

    /* @mobile_background_size */
    .td-menu-background,
    .td-search-background {
        background-size: @mobile_background_size;
    }

    /* @mobile_background_position */
    .td-menu-background,
    .td-search-background {
        background-position: @mobile_background_position;
    }


    /* @login_text_color */
    .white-popup-block,
    .mfp-content .td-login-panel-title,
    .mfp-content .td-login-inputs,
    .mfp-content .td-login-input,
    .mfp-content .td-login-info-text,
    .mfp-content #register-link,
    .mfp-content #login-form .mfp-close:before,
    .mfp-content .td-back-button i {
        color: @login_text_color;
    }
    .mfp-content .td-login-inputs:after {
        background-color: @login_text_color;
    }
    .mfp-content #register-link:before {
        border-color: @login_text_color;
    }
    /* @login_button_background */
    .mfp-content .td-login-button {
        background-color: @login_button_background;
    }
    /* @login_button_color */
    .mfp-content .td-login-button {
        color: @login_button_color;
    }
    /* @login_hover_background */
    .mfp-content .td-login-button:active,
    .mfp-content .td-login-button:hover {
        background-color: @login_hover_background;
    }
    /* @login_hover_color */
    .mfp-content .td-login-button:active,
    .mfp-content .td-login-button:hover {
        color: @login_hover_color;
    }
    /* @login_gradient_one */
    .white-popup-block:after {
        background: @login_gradient_one;
        background: -moz-linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        background: -webkit-gradient(left bottom, right top, color-stop(0%, @login_gradient_one), color-stop(100%, @login_gradient_two));
        background: -webkit-linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        background: -o-linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        background: -ms-linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        background: linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='@login_gradient_one', endColorstr='@login_gradient_two', GradientType=0 );
    }


    /* ------------------------------------------------------ */
    /* HEADER COLORS */

    /* @header_wrap_color */
    .td-header-logo-wrap {
      background-color: @header_wrap_color;
    }
    
    /* TEXT LOGO COLOR */
    /* @text_logo_color */
    .td-header-wrap .td-logo-text-container .td-logo-text {
        color: @text_logo_color;
    }

    /* TEXT LOGO TAGLINE COLOR */
    /* @text_logo_tagline_color */
    .td-header-wrap .td-logo-text-container .td-tagline-text {
        color: @text_logo_tagline_color;
    }


    /* ------------------------------------------------------ */
    /* POSTS COLORS */
    
    /* POST TITLE COLOR */
    /* @post_title_color */
    .td-post-header .entry-title {
      color: @post_title_color;
    }
    .td-post-header .entry-title:after {
      background-color: @post_title_color;
    }
    
    /* POST AUTHOR NAME COLOR */
    /* @post_author_name_color */
    .td-post-header .td-post-author-name a {
      color: @post_author_name_color;
    }
    
    /* POST TEXT COLOR */
    /* @post_content_color */
    .td-post-content,
    .td-post-content p {
    	color: @post_content_color;
    }

    /* POST H COLOR */
    /* @post_h_color */
    .td-post-content h1,
    .td-post-content h2,
    .td-post-content h3,
    .td-post-content h4,
    .td-post-content h5,
    .td-post-content h6 {
    	color: @post_h_color;
    }

    /* POST BLOCKQUOTE COLOR */
    /* @post_blockquote_color */
    .post blockquote p,
    .page blockquote p {
    	color: @post_blockquote_color;
    }
    .post .td_quote_box,
    .page .td_quote_box {
        border-color: @post_blockquote_color;
    }


    /* ------------------------------------------------------ */
    /* PAGES COLORS */
    
    /* PAGE TITLE COLOR */
    /* @page_title_color */
    .td-page-title {
    	color: @page_title_color;
    }
    
    .td-page-title:after {
        background-color: @page_title_color; 
    }

    /* PAGE TEXT COLOR */
    /* @page_content_color */
    .td-page-content,
    .td-page-content p,
    .td-page-content .td_block_text_with_title {
    	color: @page_content_color;
    }

    /* PAGE H COLOR */
    /* @page_h_color */
    .td-page-content h1,
    .td-page-content h2,
    .td-page-content h3,
    .td-page-content h4,
    .td-page-content h5,
    .td-page-content h6 {
    	color: @page_h_color;
    }
    .td-page-content .widgettitle {
        color: #fff;
    }


    /* ------------------------------------------------------ */
    /* FOOTER COLORS */
    
    /* FOOTER BACKGROUND COLOR */
    /* @footer_color */
    .td-footer-outer-wrapper {
      background-color: @footer_color;
    }
    
    /* FOOTER TEXT COLOR */
    /* @footer_text_color */
    .td-footer-wrapper,
    .td-footer-wrapper .td-pulldown-filter-display-option span,
    .td-footer-wrapper .block-title a,
    .td-footer-wrapper .block-title span,
    .td-footer-wrapper .block-title label,
    .td-footer-wrapper .rss-date,
    .td-footer-wrapper cite,
    .td-footer-outer-wrapper a,
    .footer-social-wrap .td-social-icon-wrap a,
    .footer-social-wrap .td-social-icon-wrap a span,
    .td-sub-footer-copy {
      color: @footer_text_color;
    }
    .td-subfooter-menu li:after,
    .footer-social-wrap:after,
    .td-subfooter-menu:after {
      background-color: @footer_text_color;
    }
    .td-footer-outer-wrapper .widget_categories li span:before {
      border-color: @footer_text_color;
    }

    /* FOOTER WIDGET HEADER TEXT COLOR */
    /* @footer_widget_text_color */
    .td-footer-wrapper .block-title a,
    .td-footer-wrapper .block-title span,
    .td-footer-wrapper .block-title label {
      color: @footer_widget_text_color;
    }
    
    .td-footer-wrapper .block-title:after {
      background-color: @footer_widget_text_color;
    }


    /* ------------------------------------------------------ */
    /* SUBFOOTER COLORS */
    
    /* SUBFOOTER BACKGROUND COLOR */
    /* @footer_bottom_color */
    .td-sub-footer-container {
      background-color: @footer_bottom_color;
    }
    
    /* SUBFOOTER TEXT COLOR */
    /* @footer_bottom_text_color */
    .td-sub-footer-container,
    .td-subfooter-menu li a,
    .td-sub-footer-copy {
      color: @footer_bottom_text_color;
    }
    .td-subfooter-menu li:after {
      background-color: @footer_bottom_text_color;
    }
    
    /* SUBFOOTER MENU HOVER COLOR */
    /* @footer_bottom_hover_color */
    .td-subfooter-menu .menu-item > a:hover,
    .td-subfooter-menu .sfHover > a,
    .td-subfooter-menu .current-menu-ancestor > a,
    .td-subfooter-menu .current-category-ancestor > a,
    .td-subfooter-menu .current-menu-item > a,
    .td-sub-footer-copy i {
      color: @footer_bottom_hover_color;
    }


    /* ------------------------------------------------------ */
    /* FOOTER BACKGROUND */
    
    /* @footer_background_image */
    .td-footer-outer-wrapper:before {
        background-image: url('@footer_background_image');
    }

    /* @footer_background_repeat */
    .td-footer-outer-wrapper:before {
        background-repeat: @footer_background_repeat;
    }

    /* @footer_background_size */
    .td-footer-outer-wrapper:before {
        background-size: @footer_background_size;
    }

    /* @footer_background_position */
    .td-footer-outer-wrapper:before {
        background-position: @footer_background_position;
    }

    /* @footer_background_opacity */
    .td-footer-outer-wrapper:before {
        opacity: @footer_background_opacity;
    }


    /* ------------------------------------------------------ */
    /* LOGIN MODAL BACKGROUND */

    /* @login_background_image */
    .white-popup-block:before {
        background-image: url('@login_background_image');
    }

    /* @login_background_repeat */
    .white-popup-block:before {
        background-repeat: @login_background_repeat;
    }

    /* @login_background_size */
    .white-popup-block:before {
        background-size: @login_background_size;
    }

    /* @login_background_position */
    .white-popup-block:before {
        background-position: @login_background_position;
    }

    /* @login_background_opacity */
    .white-popup-block:before {
        opacity: @login_background_opacity;
    }
    
    
    


    /* ------------------------------------------------------ */
    /* FONTS */
    
    /* @top_menu */
    .top-header-menu > li > a,
    .td-header-sp-top-menu .td_data_time,
    .td-header-sp-top-widget .td-search-btns-wrap i,
    .td-header-sp-top-widget .td-social-icon-wrap i {
       @top_menu
    }
    /* @top_sub_menu */
    .top-header-menu .sub-menu a {
    	@top_sub_menu
    }
    /* @main_menu */
    .sf-menu > li > a,
    .td-header-menu-search #td-header-search-button .td-icon-search {
        @main_menu
    }
    /* @main_sub_menu */
    .sf-menu ul .td-menu-item a {
        @main_sub_menu
    }
	/* @mega_menu */
    .td-mega-span .entry-title {
        @mega_menu
    }
    /* @mega_menu_categ */
    .td_mega_menu_sub_cats .block-mega-child-cats a {
        @mega_menu_categ
    }
    
    
    /* @blocks_title */
    .block-title > label,
    .block-title > span,
    .block-title > a,
    .widgettitle,
    .td-related-title a {
        @blocks_title
    }
    /* @blocks_author */
    .td_module_wrap .td-post-author-name a {
        @blocks_author
    }
    /* @blocks_date */
    .td_module_wrap .td-post-date .entry-date {
        @blocks_date
    }
    /* @blocks_comment */
    .td-module-comments a {
        @blocks_comment
    }
    /* @blocks_category */
    .td-big-grids .td-post-category,
    .td_module_wrap .td-post-category {
        @blocks_category
    }
    /* @blocks_filter */
    .td_block_wrap .td-wrapper-pulldown-filter {
        @blocks_filter
    }
    /* @blocks_excerpt */
    .td-excerpt {
        @blocks_excerpt
    }
    
    
    /* modules_general */
	.td_module_wrap .entry-title {
		@modules_general
	}
	/* @module_1 */
    .td_module_1 .entry-title  {
    	@module_1
    }
    /* @module_2 */
    .td_module_2 .entry-title  {
    	@module_2
    }
    /* @module_3 */
    .td_module_3 .entry-title  {
    	@module_3
    }
    /* @module_4 */
    .td_module_4 .entry-title  {
    	@module_4
    }
    /* @module_5 */
    .td_module_5 .entry-title  {
    	@module_5
    }
    /* @module_6 */
    .td_module_6 .entry-title  {
    	@module_6
    }
    /* @module_mx2 */
    .td_module_mx2 .entry-title {
    	@module_mx2
    }
    
    
    /* big grids modules */
    /* @module_mx1 */
    .td_module_mx1 .entry-title {
        @module_mx1
    }
    /* @module_mx3 */
    .td_module_mx3 .entry-title {
        @module_mx3
    }
    /* @module_mx4 */
    .td_module_mx4 .entry-title,
    .td_block_big_grid_3.td-grid-style-1 .entry-title {
        @module_mx4
    }
    
    
    /* mobile_general */
	#td-mobile-nav,
	#td-mobile-nav .wpb_button,
	.td-search-wrap-mob {
		@mobile_general
	}
    /* @mobile_menu */
    .td-mobile-content li a {
        @mobile_menu
    }
    /* @mobile_sub_menu */
    .td-mobile-content .sub-menu a {
        @mobile_sub_menu
    }
    
    
    /* post_general */
	.post .td-post-header .entry-title {
		@post_general
	}
    /* @post_title */
    .td-post-template-default .td-post-header .entry-title {
        @post_title
    }
    /* @post_content */
    .td-post-content p,
    .td-post-content {
        @post_content
    }
    /* @post_blockquote */
    .post blockquote p,
    .page blockquote p,
    .td-post-text-content blockquote p {
        @post_blockquote
    }
    /* @post_box_quote */
    .post .td_quote_box p,
    .page .td_quote_box p {
        @post_box_quote
    }
    /* @post_pull_quote */
    .post .td_pull_quote p,
    .page .td_pull_quote p {
        @post_pull_quote
    }
    /* @post_lists */
    .td-post-content li {
        @post_lists
    }
    /* @post_h1 */
    .td-post-content h1 {
        @post_h1
    }
    /* @post_h2 */
    .td-post-content h2 {
        @post_h2
    }
    /* @post_h3 */
    .td-post-content h3 {
        @post_h3
    }
    /* @post_h4 */
    .td-post-content h4 {
        @post_h4
    }
    /* @post_h5 */
    .td-post-content h5 {
        @post_h5
    }
    /* @post_h6 */
    .td-post-content h6 {
        @post_h6
    }
    /* @post_category */
    .post .td-category a {
        @post_category
    }
    /* @post_author */
    .post header .td-post-author-name,
    .post header .td-post-author-name a {
        @post_author
    }
    /* @post_date */
    .post header .td-post-date .entry-date {
        @post_date
    }
    /* @post_comment */
    .post header .td-post-views-text,
    .post header .td-post-views span,
    .post header .td-post-comments {
        @post_comment
    }
    /* @via_source_tag */
    .post .td-post-source-tags a,
    .post .td-post-source-tags span {
        @via_source_tag
    }
    /* @post_next_prev_text */
    .post .td-post-next-prev-content span {
        @post_next_prev_text
    }
    /* @post_next_prev */
    .td_block_related_posts .entry-title {
        @post_next_prev
    }
    /* @box_author_name */
    .post .author-box-wrap .td-author-name a {
        @box_author_name
    }
    /* @box_author_url */
    .post .author-box-wrap .td-author-url a {
        @box_author_url
    }
    /* @box_author_description */
    .post .author-box-wrap .td-author-description {
        @box_author_description
    }
    /* @post_share */
    .post .td-post-share-title {
        @post_share
    }
    /* @post_image_caption */
	.wp-caption-text,
	.wp-caption-dd {
		@post_image_caption
	}
    /* @post_subtitle_small */
    .td-post-template-default .td-post-sub-title {
        @post_subtitle_small
    }
    
    
    /* @page_title */
    .td-page-title,
    .td-category-header .entry-title {
    	@page_title
    }
    /* @page_content */
    .td-page-content,
    .td-page-content p,
    .td-page-content .td_block_text_with_title {
    	@page_content
    }
    /* @page_h1 */
    .td-page-content h1 {
    	@page_h1
    }
    /* @page_h2 */
    .td-page-content h2 {
    	@page_h2
    }
    /* @page_h3 */
    .td-page-content h3 {
    	@page_h3
    }
    /* @page_h4 */
    .td-page-content h4 {
    	@page_h4
    }
    /* @page_h5 */
    .td-page-content h5 {
    	@page_h5
    }
    /* @page_h6 */
    .td-page-content h6 {
    	@page_h6
    }
    
    /* @footer_text_about */
	.footer-text-wrap {
		@footer_text_about
	}
	/* @footer_copyright_text */
	.td-sub-footer-copy {
		@footer_copyright_text
	}
	/* @footer_menu_text */
	.td-sub-footer-menu li a {
		@footer_menu_text
	}
    
    
    /* @breadcrumb */
    .entry-crumbs a,
    .entry-crumbs span  {
    	@breadcrumb
    }
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
	.td_ajax_load_more,
	.vc_btn {
		@default_buttons
	}
	
	
	/* @body_text */
    body, p {
    	@body_text
    }
    </style>
    ";



    $td_css_compiler = new td_css_compiler($raw_css);


    //output the style
    return $td_fonts_css_buffer . $td_css_compiler->compile_css();

}