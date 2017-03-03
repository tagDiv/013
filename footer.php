<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #site-content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage MeisterMag
 * @since MeisterMag 1.0
 */

?>

	</div><!-- #site-content -->
	<!--site footer-->
	<footer class="site-footer" role="contentinfo">
		<div class="tagdiv-footer-wrapper td-container-wrap">
			<!-- footer -->
			<div class="tagdiv-footer-container">
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

								<?php
								$tagdiv_theme_options = get_theme_mod( 'tagdiv_theme_options' );
								if ( !empty( $tagdiv_theme_options[ 'tagdiv_footer_logo' ] ) ) { ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
										<img src="<?php echo $tagdiv_theme_options['tagdiv_footer_logo'] ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
									</a>
								<?php } ?>

							</aside>
						</div>

						<!--description & email-->
						<div class="td-pb-span12">
							<aside class="footer-text-wrap">

								<?php if ( !empty( $tagdiv_theme_options[ 'tagdiv_footer_text' ] ) ) { ?>
								<?php echo $tagdiv_theme_options['tagdiv_footer_text'] ?>
								<?php } ?>

								<div class="footer-email-wrap">
									<?php if ( !empty( $tagdiv_theme_options[ 'tagdiv_footer_email' ] ) ) { ?>
									<?php _e( 'Contact us:', 'meistermag' ); ?>
										<a href="<?php echo $tagdiv_theme_options[ 'tagdiv_footer_email' ] ?>"><?php echo $tagdiv_theme_options[ 'tagdiv_footer_email' ] ?></a>
									<?php } ?>
								</div>
							</aside>
						</div>
					</div>
				</div> <!-- /.td-container -->
			</div> <!-- /.tagdiv-footer-container -->

			<!-- sub footer -->
			<div class="tagdiv-sub-footer-container">
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
							$tagdiv_footer_copy_symbol = $tagdiv_theme_options[ 'tagdiv_subfooter_copyright_symbol' ];
							$tagdiv_footer_copyright   = stripslashes( $tagdiv_theme_options[ 'tagdiv_subfooter_copyright' ] );

							//show copyright symbol
							if ( !empty( $tagdiv_footer_copy_symbol ) ) {
								echo '&copy; ';
							}

							echo $tagdiv_footer_copyright;
							?>
						</div>
					</div>
				</div> <!-- /.td-container -->
			</div> <!-- /.tagdiv-sub-footer-container -->
		</div> <!-- /.tagdiv-footer-wrapper -->
	</footer> <!-- /.site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
