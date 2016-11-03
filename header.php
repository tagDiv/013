<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package WordPress
 * @subpackage MeisterMag
 * @since MeisterMag 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- mobile navigation -->
<div class="td-menu-background"></div>
<div id="td-mobile-nav">
	<div class="td-mobile-container">

		<!-- close button -->
		<div class="td-mobile-close">
			<a href="#"><i class="td-icon-close-mobile"></i></a>
		</div>

		<!-- menu section -->
		<div class="td-mobile-content">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'header-menu',
				'menu_class'	 => 'td-mobile-main-menu',
				'fallback_cb' 	 => 'td_wp_no_mobile_menu',
				'link_after' 	 => '<i class="td-icon-menu-right td-element-after"></i>',
				'walker'  		 => new td_walker_mobile_menu()
			) );

			/* if no menu */
			function td_wp_no_mobile_menu() {
				//this is the default menu
				echo '<ul class="">';
				echo '<li class="menu-item-first"><a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php">Click here - to use the wp menu builder</a></li>';
				echo '</ul>';
			}
			?>
		</div>

	</div>
</div>

<!-- mobile search -->
<div class="td-search-background"></div>
<div class="td-search-wrap-mob">

	<div class="td-drop-down-search" aria-labelledby="td-header-search-button">

		<form method="get" class="td-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<!-- close button -->
			<div class="td-search-close">
				<a href="#"><i class="td-icon-close-mobile"></i></a>
			</div>

			<div role="search" class="td-search-input">
				<span><?php _e( 'Search', 'meistermag' )?></span>
				<input id="td-header-search-mob" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
			</div>
		</form>

	</div>

</div>

<div id="page" class="site">
	<!--site header-->
	<header class="site-header" role="banner">
		<div class="tagdiv-header-wrap tagdiv-header-style">
			<div class="td-header-logo-wrap td-container-wrap">

				<a class="skip-link screen-reader-text" href="#site-content"><?php _e( 'Skip to content', 'meistermag' ); ?></a>

				<div class="td-container">
					<div class="tagdiv-header-logo">
						<?php tagdiv_custom_logo(); ?>
					</div> <!-- /.tagdiv-header-logo -->
				</div>
			</div>

			<div class="td-header-menu-wrap-full td-container-wrap">
				<div class="td-header-menu-wrap"> <!-- /.td-header-menu-wrap -->
					<div class="td-container td-header-main-menu">

						<div id="td-header-menu" role="navigation">

							<!--mobile menu-->
							<div id="td-top-mobile-toggle"><a href="#"><i class="td-icon-font td-icon-mobile"></i></a></div>
								<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'meistermag' ); ?>">
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
								</nav><!-- .main-navigation -->
						</div> <!--td-header-menu-->

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
												<span class="screen-reader-text"><?php _e( 'Search for:', 'meistermag' ) ?></span>
												<input id="td-header-search" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
												<input class="wpb_button wpb_btn-inverse btn" type="submit" id="td-header-search-top" value="<?php _e( 'Search', 'meistermag' ) ?>" />
											</label>
										</div>
									</form>
								</div>
							</div> <!-- /.td-search-box-wrap -->
						</div> <!-- /.td-header-menu-search -->

					</div> <!-- /.td-header-main-menu -->
				</div>
			</div> <!-- /.td-header-menu-wrap-full -->
		</div> <!-- /.tagdiv-header-wrap -->

	</header> <!-- /.site-header-->
	<!--site content-->
	<div id="site-content" class="site-content" tabindex="-1">
