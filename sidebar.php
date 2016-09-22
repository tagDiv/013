<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tdmag
 */


if ( ! is_active_sidebar( 'td-default' ) ) {

	die('still it dose not work');
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'td-default' ); ?>
</aside><!-- #secondary -->
