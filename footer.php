<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #tagdiv-site-content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage MeisterMag
 * @since MeisterMag 1.0
 */

?>

	</div><!-- #tagdiv-site-content -->
	<!--site footer-->
	<div class="tagdiv-footer-wrapper">
		<div class="tagdiv-footer-container">
			<div class="tagdiv-container">
				<div class="tagdiv-row">
					<div class="tagdiv-span4">
						<?php dynamic_sidebar( __( 'Footer 1', 'meistermag' ) ); ?>
					</div>

					<div class="tagdiv-span4">
						<?php dynamic_sidebar( __( 'Footer 2', 'meistermag' ) ); ?>
					</div>

					<div class="tagdiv-span4">
						<?php dynamic_sidebar( __( 'Footer 3', 'meistermag' ) ); ?>
					</div>
				</div>

				<div class="tagdiv-row">
					<!--logo-->
					<div class="tagdiv-span12">
						<aside class="footer-logo-wrap">

							<?php
							if ( !empty( Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_footer_logo' ) ) ) { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tagdiv-custom-logo-link" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<img src="<?php echo Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_footer_logo' ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								</a>
							<?php } ?>

						</aside>
					</div>

					<!--description & email-->
					<div class="tagdiv-span12">
						<aside class="footer-text-wrap">

							<?php if ( !empty( Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_footer_text' ) ) ) { ?>
							<?php echo Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_footer_text' ) ?>
							<?php } ?>

							<div class="footer-email-wrap">
								<?php if ( !empty( Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_footer_email' ) ) ) { ?>
								<?php _e( 'Contact us:', 'meistermag' ); ?>
									<a href="<?php echo Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_footer_email' ) ?>"><?php echo Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_footer_email' ) ?></a>
								<?php } ?>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</div>

		<!-- site sub footer -->
		<div class="tagdiv-sub-footer-container">
			<div class="tagdiv-container">
				<div class="tagdiv-row">
					<!--footer menu-->
					<div class="tagdiv-span12 tagdiv-sub-footer-menu">
						<nav class="tagdiv-footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'meistermag' ); ?>">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'footer-menu',
							'menu_class'	 => 'tagdiv-subfooter-menu',
							'fallback_cb' 	 => 'tagdiv_wp_footer_menu',
						) );

						//if no menu
						function tagdiv_wp_footer_menu() {
							//do nothing
						}
						?>
						</nav>
					</div>

					<div class="tagdiv-span12 tagdiv-sub-footer-copy">
						<?php
						$tagdiv_footer_copy_symbol = Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_subfooter_copyright_symbol' );
						$tagdiv_footer_copyright   = stripslashes( Tagdiv_Util::tagdiv_get_theme_options( 'tagdiv_subfooter_copyright' ) );

						//show copyright symbol
						if ( !empty( $tagdiv_footer_copy_symbol ) ) {
							echo '&copy; ';
						}

						echo $tagdiv_footer_copyright;
						?>
					</div>
				</div>
			</div> <!-- /.tagdiv-container -->
		</div> <!-- /.tagdiv-sub-footer-container -->
	</div> <!-- /.tagdiv-footer-wrapper -->
</div><!-- #tagdiv-page-wrap -->

<?php wp_footer(); ?>

</body>
</html>
