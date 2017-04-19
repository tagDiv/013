<?php
/**
 * Template for displaying search forms in our theme
 *
 * @since MeisterMag 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search for:', 'meistermag' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php _e( 'Search &hellip;', 'meistermag' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php _e( 'Search', 'meistermag' ); ?></span><?php _e( 'Search', 'meistermag' ) ?></button>
</form>
