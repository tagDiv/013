<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tdmag
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">


		<div class="td-footer-outer-wrapper td-container-wrap">

			<!-- Footer -->

			<div class="td-footer-wrapper">
				<div class="td-container">
					<div class="td-pb-row">
						<div class="td-pb-span4">
							<?php dynamic_sidebar('Footer 1'); ?>
						</div>

						<div class="td-pb-span4">
							<?php dynamic_sidebar('Footer 2'); ?>
						</div>

						<div class="td-pb-span4">
							<?php dynamic_sidebar('Footer 3'); ?>
						</div>
					</div>

					<div class="td-pb-row">

						<!--logo-->
						<div class="td-pb-span12">
							<aside class="footer-logo-wrap">
								<a href="<?php echo esc_url(home_url( '/' )); ?>"><img src="<?php echo Tagdiv_Global::$get_template_directory_uri . '/images/logo_footer.png'?>" alt="footer-logo-alt" title="td-footer-logo-title"/></a>
							</aside>
						</div>

						<!--description & email-->
						<div class="td-pb-span12">
							<aside class="footer-text-wrap">
								tdmag is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry.

								<div class="footer-email-wrap">
									Contact us: <a href="mailto:contact@yoursite.com">contact@yoursite.com</a>
								</div>
							</aside>
						</div>

					</div>
				</div>
			</div>

			<!-- Sub Footer -->

				<div class="td-sub-footer-container">
					<div class="td-container">
						<div class="td-pb-row">
							<div class="td-pb-span12 td-sub-footer-menu">
								<?php
								wp_nav_menu(array(
									'theme_location' => 'footer-menu',
									'menu_class'=> 'td-subfooter-menu',
									'fallback_cb' => 'td_wp_footer_menu'
								));

								//if no menu
								function td_wp_footer_menu() {
									//do nothing?
								}
								?>
							</div>

							<div class="td-pb-span12 td-sub-footer-copy">
								&copy; 2016 ELM - All rights reserved. Free WordPress Theme created with <i class="td-icon-heart"></i> by <b>tagDiv</b>.
							</div>
						</div>
					</div>
				</div>

		</div>



			<!--<div class="site-info">
				<a href="<?php /*echo esc_url( __( 'https://wordpress.org/', 'tdmag' ) ); */?>"><?php /*printf( esc_html__( 'Proudly powered by %s', 'tdmag' ), 'WordPress' ); */?></a>
				<span class="sep"> | </span>
				<?php /*printf( esc_html__( 'Theme: %1$s by %2$s.', 'tdmag' ), 'tdmag', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); */?>
			</div>--><!-- .site-info -->



	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
