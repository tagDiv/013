<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage tdmag
 * @since TAGDIV_THEME_NAME 1.0
 */

?>

	</div><!-- #content -->

	<!-- footer -->
	<footer class="site-footer" role="contentinfo">

		<div class="td-footer-outer-wrapper td-container-wrap">
			<div class="td-footer-wrapper">
				<div class="td-container">
					<div class="td-pb-row">
						<div class="td-pb-span4">
							<?php dynamic_sidebar( 'Footer 1' ); ?>
						</div>

						<div class="td-pb-span4">
							<?php dynamic_sidebar( 'Footer 2' ); ?>
						</div>

						<div class="td-pb-span4">
							<?php dynamic_sidebar( 'Footer 3' ); ?>
						</div>
					</div>

					<div class="td-pb-row">

						<!--logo-->
						<div class="td-pb-span12">
							<aside class="footer-logo-wrap">

								<?php if ( get_theme_mod( 'tagdiv_footer_logo' ) ) { ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<img src="<?php echo get_theme_mod( 'tagdiv_footer_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
									</a>
								<?php } ?>

							</aside>
						</div>

						<!--description & email-->
						<div class="td-pb-span12">
							<aside class="footer-text-wrap">
								<?php echo get_option( 'tagdiv_footer_text' ); ?>

								<div class="footer-email-wrap">

									<?php echo __td( 'Contact us:', 'tdmag' ); ?>
									<a href="<?php echo get_option( 'tagdiv_footer_email' ); ?>"><?php echo get_option( 'tagdiv_footer_email' ); ?></a>

								</div>
							</aside>
						</div>

					</div>
				</div>
			</div>

				<!-- sub footer -->
				<div class="td-sub-footer-container">
					<div class="td-container">
						<div class="td-pb-row">
							<div class="td-pb-span12 td-sub-footer-menu">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'footer-menu',
									'menu_class'	 => 'td-subfooter-menu',
									'fallback_cb' 	 => 'td_wp_footer_menu',
								) );

								//if no menu
								function td_wp_footer_menu() {
									//do nothing
								}
								?>
							</div>

							<div class="td-pb-span12 td-sub-footer-copy">

								<?php
								$tagdiv_footer_copyright = stripslashes( get_option( 'tagdiv_subfooter_copyright' ) );
								$tagdiv_footer_copy_symbol = get_theme_mod( 'tagdiv_subfooter_copyright_symbol' );

								//show copyright symbol
								if ( $tagdiv_footer_copy_symbol ) {
									echo '&copy; ';
								}

								echo $tagdiv_footer_copyright;
								?>

							</div>
						</div>
					</div>
				</div>

		</div>

	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
