<?php
/**
 * The header of the theme.
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

	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- mobile navigation -->
<div class="tagdiv-menu-background"></div>
<div id="tagdiv-mobile-nav">
	<div class="tagdiv-mobile-container">
		<!-- close button -->
		<div class="tagdiv-mobile-close">
			<a href="#"><i class="tagdiv-icon-close-mobile"></i></a>
		</div>
		<!-- menu section -->
		<div class="tagdiv-mobile-content">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'header-menu',
				'menu_class'	 => 'tagdiv-mobile-main-menu',
				'fallback_cb' 	 => 'tagdiv_wp_no_mobile_menu',
				'link_after' 	 => '<i class="tagdiv-icon-menu-right tagdiv-element-after"></i>',
				'walker'  		 => new tagdiv_walker_mobile_menu()
			) );

			//if no menu
			function tagdiv_wp_no_mobile_menu() {
				//this is the default menu
				echo '<ul class="">';
				echo '<li class="tagdiv-menu-item-first"><a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php">' . __('Click here - to use the wp menu builder', 'meistermag') . '</a></li>';
				echo '</ul>';
			}
			?>
		</div>
	</div>
</div>

<!-- mobile search -->
<div class="tagdiv-search-background"></div>
<div class="tagdiv-search-wrap-mob">
	<div class="tagdiv-drop-down-search" aria-labelledby="tagdiv-header-search-button">
		<form method="get" class="tagdiv-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="tagdiv-search-close">
				<a href="#"><i class="tagdiv-icon-close-mobile"></i></a>
			</div>

			<div role="search" class="tagdiv-search-input">
				<span><?php _e( 'Search', 'meistermag' )?></span>
				<input id="tagdiv-header-search-mob" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
			</div>
		</form>
	</div>
</div>

<div id="tagdiv-page-wrap" class="tagdiv-site">
	<!--site header-->
	<div class="tagdiv-header-wrap tagdiv-header-style">
		<div class="tagdiv-container">
			<a class="skip-link screen-reader-text" href="#tagdiv-site-content"><?php _e( 'Skip to content', 'meistermag' ); ?></a>

			<div class="tagdiv-header-logo-wrap">
				<!--header logo-->
				<div class="tagdiv-header-logo">
					<?php tagdiv_custom_logo(); ?>
				</div>
			</div>
		</div>

		<!--header menu-->
		<div class="tagdiv-header-menu-wrap">
			<div class="tagdiv-container tagdiv-header-main-menu">
				<div id="tagdiv-header-menu" role="navigation">
					<!--mobile menu toggle button-->
					<div id="tagdiv-top-mobile-toggle"><a href="#"><i class="tagdiv-icon-font tagdiv-icon-mobile"></i></a></div>

					<nav class="tagdiv-main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Header Menu (main)', 'meistermag' ); ?>">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'header-menu',
						'menu_class'	 => 'tagdiv-sf-menu',
						'fallback_cb' 	 => 'tagdiv_wp_page_menu',
					) );

					//if no menu
					function tagdiv_wp_page_menu() {
						echo '<ul class="tagdiv-sf-menu">';
						echo '<li class="tagdiv-menu-item-first"><a href="' . esc_url(home_url( '/' )) . 'wp-admin/nav-menus.php?action=locations">' . __('Click here - to select or create a menu', 'meistermag') . '</a></li>';
						echo '</ul>';
					}
					?>
					</nav>
				</div>
				<!--header menu search-->
				<div class="tagdiv-header-menu-search">
					<div class="tagdiv-search-btns-wrap">
						<a id="tagdiv-header-search-button" href="#" role="button" data-toggle="dropdown"><i class="tagdiv-icon-search"></i></a>
						<a id="tagdiv-header-search-button-mob" href="#" role="button" data-toggle="dropdown"><i class="tagdiv-icon-search"></i></a>
					</div>
					<div class="tagdiv-search-box-wrap">
						<div class="tagdiv-drop-down-search" aria-labelledby="tagdiv-header-search-button">
							<form method="get" class="tagdiv-search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
								<div role="search" class="tagdiv-head-search">
									<label>
										<span class="screen-reader-text"><?php _e( 'Search for:', 'meistermag' ) ?></span>
										<input id="tagdiv-header-search" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
										<input class="wpb_button wpb_btn-inverse btn" type="submit" id="tagdiv-header-search-top" value="<?php _e( 'Search', 'meistermag' ) ?>" />
									</label>
								</div>
							</form>
						</div>
					</div>
				</div> <!-- /.tagdiv-header-menu-search -->
			</div> <!-- /.tagdiv-header-main-menu -->
		</div> <!-- /.tagdiv-header-menu-wrap -->
	</div> <!-- /.tagdiv-header-wrap -->
	<!--site content-->
	<div id="tagdiv-site-content" class="tagdiv-site-content" tabindex="-1">
