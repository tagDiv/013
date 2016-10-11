<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header class="site-header" role="banner">
		<div class="tagdiv-header-wrap tagdiv-header-style">
			<div class="td-header-logo-wrap td-container-wrap">

				<a class="skip-link screen-reader-text" href="#site-content"><?php _e( 'Skip to content', 'tdmag' ); ?></a>

				<div class="td-container">

					<div class="td-header-sp-logo">
						<?php tagdiv_custom_logo(); ?>
					</div>

				</div>
			</div>

			<div class="td-header-menu-wrap-full td-container-wrap">
				<div class="td-header-menu-wrap">
					<div class="td-container td-header-main-menu">

						<div id="td-header-menu" role="navigation">

							<!--mobile menu-->
							<!--<div id="td-top-mobile-toggle"><a href="#"><i class="td-icon-font td-icon-mobile"></i></a></div>-->

							<?php
							wp_nav_menu( array(
								'theme_location' => 'header-menu',
								'menu_class'	 => 'sf-menu',
								'fallback_cb' 	 => 'td_wp_page_menu',
							) );

							//if no menu
							function td_wp_page_menu() {
								echo '<ul class="sf-menu">';
								echo '<li class="menu-item-first"><a href="' . esc_url(home_url( '/' )) . 'wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>';
								echo '</ul>';
							}
							?>
						</div>

						<div class="td-header-menu-search">
							<div class="td-search-btns-wrap">
								<a id="td-header-search-button" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><i class="td-icon-search"></i></a>
								<a id="td-header-search-button-mob" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><i class="td-icon-search"></i></a>
							</div>

							<div class="td-search-box-wrap">
								<div class="tagdiv-drop-down-search" aria-labelledby="td-header-search-button">
									<form method="get" class="tagdiv-search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
										<div role="search" class="tagdiv-head-search">
											<label>
												<span class="screen-reader-text"><?php _e( 'Search for:', 'tdmag' ) ?></span>
												<input id="td-header-search" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
												<input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="<?php _e( 'Search', 'tdmag' ) ?>" />
											</label>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</header> <!--site-header-->

	<div id="site-content" class="site-content" tabindex="-1">
