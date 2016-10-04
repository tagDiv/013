<?php

/*  ----------------------------------------------------------------------------
    This is the search box used at the top of the search results
    It's used by /search.php
 */

?>

<h1 class="entry-title td-page-title">
    <span class="td-search-query"><?php echo get_search_query(); ?></span> - <span> <?php  echo __td('search results', 'tdmag');?></span>
</h1>

<div class="search-page-wrap">
    <form method="get" class="td-search-form-widget" action="<?php echo esc_url(home_url( '/' )); ?>">
        <div role="search">
            <label>
                <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'tdmag' ); ?></span>
                <input class="td-widget-search-input" type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'tdmag' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" />
            </label>

            <input class="wpb_button wpb_btn-inverse btn" type="submit" id="searchsubmit" value="<?php echo __td('Search', 'tdmag')?>" />
        </div>
    </form>
</div>