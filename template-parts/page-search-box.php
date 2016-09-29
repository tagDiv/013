<?php

/*  ----------------------------------------------------------------------------
    This is the search box used at the top of the search results
    It's used by /search.php


 */

/**
 * @note:
 * we use esc_url(home_url( '/' )) instead of the WordPress @see get_search_link function because that's what the internal
 * WordPress widget it's using and it was creating duplicate links like: yoursite.com/search/search_query and yoursite.com?s=search_query
 */

?>

<h1 class="entry-title td-page-title">
    <span class="td-search-query"><?php echo get_search_query(); ?></span> - <span> <?php  echo __td('search results', 'tdmag');?></span>
</h1>

<div class="search-page-wrap">
    <form method="get" class="td-search-form-widget" action="<?php echo esc_url(home_url( '/' )); ?>">
        <div role="search">
            <input class="td-widget-search-input" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
            <input class="wpb_button wpb_btn-inverse btn" type="submit" id="searchsubmit" value="<?php echo __td('Search', 'tdmag')?>" />
        </div>
    </form>
</div>