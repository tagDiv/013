<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tdmag
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
		<div class="td-header-wrap td-header-style">
			<div class="td-header-logo-wrap td-container-wrap">

				<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'tdmag' ); ?></a>

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
								<div class="td-drop-down-search" aria-labelledby="td-header-search-button">
									<form method="get" class="td-search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
										<div role="search" class="td-head-form-search-wrap">
											<label>
												<span class="screen-reader-text"><?php echo __td( 'Search for:', 'tdmag' ) ?></span>
												<input id="td-header-search" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" /><input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="Search" />
											</label>
										</div>
									</form>
									<div id="td-aj-search"></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</header> <!--site-header-->

	<div id="content" class="site-content" tabindex="-1">
